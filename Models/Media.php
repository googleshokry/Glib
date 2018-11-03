<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 09:19 م
 */

namespace Glib\Models;


use Glib\Models\Contracts\MediaAble;
use Glib\Upload\MediaFile;

/**
 * @property mixed file_name
 * @property mixed field_name
 * @property mixed model_id
 * @method static $this whereModelId($id)
 * @method  $this whereModel($model)
 */
class Media extends BaseModel
{
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub


        static::deleting(function (Media $item) {
            MediaFile::make($item->getName())->delete();
        });
    }

    public function getName()
    {
        return $this->file_name;
    }

    public function getFieldName()
    {
        return $this->field_name;
    }

    public function getModelId()
    {
        return $this->model_id;
    }

    public static function insertNewMedia(BaseModel $model, $files, $type = "", $name = "default")
    {
        $arr = [];

        foreach ($files as $file) {
            $arr[] = [
                "file_name" => $file,
                "type" => $type ?? "",
                "field_name" => $name ?? "default",
                "model" => $model->getTable(),
                "model_id" => $model->id,
            ];

        }

        self::insert($arr);
    }

    public static function getLinkedMedia(BaseModel $model)
    {
        return self::whereModelId($model->id)->whereModel($model->getTable());
    }
}