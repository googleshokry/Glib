<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 10:55 ص
 */

namespace Glib\Controllers;


use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Glib\Models\BaseModel;
use Glib\Models\Contracts\MediaAble;
use Glib\Support\PaginationSupport;


/**
 * Class AbstractRepo
 *
 *  abstract repo for reposatories that use for make easy to develop
 * @package Glib\Controllers
 */
abstract class AbstractRepo
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var BaseModel
     */
    protected $query;
    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @return BaseModel
     */
    abstract public function getModel(): BaseModel;

    /**
     * @return array
     */
    abstract public function prepareForSaving(): array;

    /**
     * @return array
     */
    abstract public function prepareForUpdate(): array;

    /**
     * @param Request|null $request
     * @return static
     */
    public static function make(Request $request = null)
    {
        return new static($request ?? request());
    }

    /**
     * AbstractRepo constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = $this->getModel();
    }

    /**
     * @param \Closure|null $callback
     * @return Collection
     */
    public function all(\Closure $callback = null)
    {
        $data = $this->query->get();

        if (is_callable($callback))
            return $callback($data);

        return $data;

    }

    /**
     * @param \Closure|null $callback
     * @return $this|mixed
     */
    public function first(\Closure $callback = null)
    {
        $data = $this->query->first();

        if (is_callable($callback))
            return $callback($data);

        return $data;
    }

    /**
     * @param \Closure $callback
     * @return mixed
     */
    public function get(\Closure $callback)
    {
        $data = $this->query->get();

        if (is_callable($callback))
            return $callback($data);

        return $data;
    }

    /**
     * @return $this
     */
    public function filter()
    {
        $this->query = $this->getModel()->filter($this->request);

        return $this;
    }

    /**
     * @param int $num
     * @param \Closure|null $callback
     * @return mixed
     */
    public function paginate($num = null, \Closure $callback = null)
    {



        $data = $this->query->paginate(PaginationSupport::getLimit($num));


        if (is_callable($callback))
            return $callback($data);

        return $data->appends($this->request->all());
    }


    /**
     * @param \Closure $callback
     * @return $this
     */
    public function customQuery(\Closure $callback)
    {
        $this->query = $callback($this->query);
        return $this;
    }

    /**
     * @return BaseModelcreate admin

     */
    public function create()
    {
        return $this->getModel()->create(array_merge($this->prepareForSaving(), $this->parameters))->updateRelatedModels();
    }

    /**
     * @param null $id
     * @return bool
     */
    public function update($id = null)
    {

        $row = $this->getModel()->find($id ?? $this->request->id);
        $status = $row->update(array_merge($this->prepareForUpdate(), $this->parameters));
        $row->touch();
        $row->updateRelatedModels();
        return $status;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function appendParametersToInsert(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    /**
     * @param $id
     * @return $this
     */
    public function findOrFail($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    /**
     * @param $id
     * @param \Closure|null $befogDelete
     * @return bool
     * @throws \Exception
     */
    public function destroy($id, \Closure $befogDelete = null)
    {
        $canDelete = true;
        $row = $this->findOrFail($id);
        /**
         * $befogDelete must return null
         */
        $canDelete = (is_callable($befogDelete)) ? $befogDelete($row) : $canDelete;


        if (!is_bool($canDelete))
            throw new \Exception("destroy Closure must return bool");

        return ($canDelete) ? $row->delete() : false;
    }


}