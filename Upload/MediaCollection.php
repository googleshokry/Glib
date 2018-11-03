<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 22/04/18
 * Time: 11:10 ص
 */

namespace Glib\Upload;


use Illuminate\Database\Eloquent\Collection as ElquentCollection;

use Illuminate\Support\Str;
use Glib\Models\Contracts\MediaAble;
use Glib\Models\Media;


/**
 * Class MediaCollection
 * @package Glib\Upload
 */
class MediaCollection
{
    private $items;
    /**
     * @var MediaAble
     */
    private $model;

    public function __construct(MediaAble $model)
    {

        $this->model = $model;
        $this->items = Collection::make();
        foreach ($model->getMediaFiles() as $name => $type) {
            if ($type == "single") {
                $this->items->put($name, new MediaFile($model->{$name}));
            } else {
                $this->model->getLinkedMedia()
                    ->groupBy("field_name")
                    ->each(function (ElquentCollection $items, $key) {

                        $this->items->put($key, Collection::make($items->map(function (Media $item) {
                            return new MediaFile($item->getName(), $item->getId());
                        })->getIterator()));
                    });
            }
        }
//        dd($this->items);

    }

    /**
     * @param $name
     * @param $arguments
     * @return MediaFile
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $colName = Str::lower(Str::snake(lcfirst(str_replace("get", "", $name))));

        return $this->getByName($colName);

//        throw new \Exception("Image [$colName] not found");
    }

    public function first()
    {
        return $this->items->first();
    }

    /**
     * @param $name
     * @return MediaFile
     */
    public function getByName($name)
    {
        return $this->items->get($name);
    }

    /**
     * @param $name
     * @return Collection
     */
    public function getCollection($name)
    {

//        dd($this->items->get($name));


        return $this->items->get($name) ?? Collection::make();
    }

}
