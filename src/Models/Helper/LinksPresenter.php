<?php

namespace Glib\Models\Helper;

use Glib\Models\BaseModel;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 28/04/18
 * Time: 11:20 ص
 */
class LinksPresenter
{
    /**
     * @var BaseModel
     */
    private $model;
    /**
     * @var null
     */
    private $routeName;
    /**
     * @var string
     */
    private $scope;

    public function __construct(BaseModel $model, $routeName = null, $scope = "")
    {
        $this->model = $model;
        $this->routeName = $routeName ?? str_plural($this->model->getTable());
        $this->scope = $scope;

//       dd();
    }

    private function route($name, array $options = [])
    {


        return route("$this->scope.$this->routeName.$name", array_merge([$this->model->getId()], $options));

    }

    public function index(array $options = [])
    {
        return $this->route("index", $options);
    }

    public function create(array $options = [])
    {
        return $this->route("create", $options);
    }

    public function edit(array $options = [])
    {
        return $this->route("edit", $options);
    }

    public function store(array $options = [])
    {
        return $this->route("store", $options);
    }

    public function update(array $options = [])
    {
        return $this->route("update", $options);
    }

    public function delete(array $options = [])
    {
        return $this->route("delete", $options);
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope(string $scope)
    {
        $this->scope = $scope;
        return $this;
    }
}