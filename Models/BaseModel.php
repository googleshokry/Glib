<?php

namespace Glib\Models;

use App\Models\Interfaces\TypeAble;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Glib\Encryption\StringNumber;
use Glib\FeatureAble\Contracts\FeatureAble;
use Glib\Models\Contracts\MediaAble;
use Glib\Models\Contracts\Slugable;
use Glib\Models\Helper\LinksPresenter;
use Glib\SEO\Contracts\SEOable;
use Glib\Tag\Contracts\Tagable;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 12/04/18
 * Time: 01:13 م
 * @property int id
 * @method static $this firstOrNew(array $fields, array $data = [])
 * @method  static $this findOrFail($id)
 * @method  $this where(...$attrs)
 * @method  static insert(array $data)
 * @method  $this count()
 * @method  $this first()
 * @method static truncate()
 */
class BaseModel extends Model
{
    protected $guarded = [];

    /**
     * @param array $attributes
     * @return static
     */
    public static function make(array $attributes = [])
    {
        return new static($attributes);
    }

    public function getClass()
    {
        return static::class;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function encryptId()
    {
        return (new IDEncryption($this->getId()))->encryptId();
    }

    public function encryptIdWithClassHash()
    {
        return $this->encryptId() . "-" . StringNumber::encrypt(static::class);
    }

    public function getItemId(): string
    {
        return $this->encryptIdWithClassHash();
    }

    public static function decryptId($id)
    {
        return (new IDEncryption($id))->decryptId();
    }

    /**
     * @param $id
     * @return static
     */
    public static function findByEncryptedIdAndClassHash($id)
    {


        list($itemId, $classHashed) = explode("-", $id);
        /**
         * @var self $class
         */
        $class = StringNumber::decrypt($classHashed);

        return $class::findByEncryptedId($itemId);
    }

    public static function findByEncryptedId($id)
    {
        return self::findOrFail(self::decryptId($id));
    }

    /**
     * @param $id
     * @return static
     */
    public function FBEncryptedId($id)
    {
        return self::findOrFail(self::decryptId($id));
    }

    protected static function boot()
    {
        parent::boot();


        static::creating(function ($row) {

            if ($row instanceof TypeAble)
                $row->type = $row->getTypes();

            if ($row instanceof Slugable)
                $row->makeSlug();


        });


        static::updating(function ($row) {

            if ($row instanceof Slugable)
                $row->makeSlug();


        });

        /**
         * update delete
         */
        static::deleting(function ($row) {


            if ($row instanceof MediaAble)
                $row->deleteImageFile();


            if ($row instanceof SEOable)
                $row->deleteSeo();

            if ($row instanceof FeatureAble)
                $row->unFeature();

        });
    }

    /**
     * @param $data
     * @return static
     */
    public static function quickSave($data)
    {
        return (new static)->create($data);
    }

    public static function upsart(array $fields, array $data = [])
    {
        /** @var self $row */
        $row = static::firstOrNew($fields);

        foreach ($data as $k => $v) {
            $row->{$k} = $v;
        }

        $row->save();

        return $row;
    }

    /**3
     * @param $data
     * @return static
     */
    public static function quickUpdate(array $data)
    {
        $row = (new static)->findOrFail($data['id']);
        $row->update($data);
        return $row;
    }

    public static function quickDelete($id)
    {
        return (new static)->destroy($id);
    }

    /**
     *
     * this check if model has col in other tabel
     * if it return number larger than  0
     * it abort mission
     * and return 0 as parent
     * @param BaseModel $model
     * @param $col
     * @return int
     */
    public function checkBefogDelete(BaseModel $model, $col)
    {

        if ($model->where($col, $this->id)->count())
            return 0;
        return self::quickDelete($this->id);
    }

    public function getTableColumns($exeptions = [])
    {

        $arr = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());

        foreach ($exeptions as $col) {
            if (($key = array_search($col, $arr)) !== false) {
                unset($arr[$key]);
            }
        }
        return $arr;
    }

    /**
     * @param Request $request
     * @return    Builder|static
     */
    public function filter(Request $request = null)
    {

        $self = new static();

        if ($request->get("order-by") && $request->get("order"))
            $self = $self->orderBy($request->get("order-by"), $request->get("order"));

        if ($self instanceof TypeAble)
            $self = $self->where('type', $self->getTypes());

        return $self;
    }

    /**
     * @param $title
     * @param null $id
     * @param \Closure|null $closure
     * @return Collection
     */
    public function getAsList($title, $id = null, \Closure $closure = null)
    {


        $query = new static();

        if (is_callable($closure))
            $query = $closure($query);


        $data = $query->pluck($title, $id ?? "id");

        return $data;

    }

    /**
     * @param $title
     * @param null $id
     * @param \Closure|null $closure
     * @return Collection
     */
    public static function asList($title, $id = null, \Closure $closure = null)
    {
        return (new static())->getAsList($title, $id, $closure);
    }

    public function updateRelatedModels()
    {
        if ($this instanceof MediaAble)
            $this->updateMedia();


        if ($this instanceof SEOable)
            $this->updateSeoRecord();

        if ($this instanceof Tagable)
            $this->updateTagRecord();

        if ($this instanceof FeatureAble)
            $this->changeFeatureStatus();


        return $this;
    }

    /**
     * @return LinksPresenter
     */
    public function linksPresenter(): LinksPresenter
    {
//        dd($this instanceof UrlRoutable);
        return new LinksPresenter($this);
    }


}