<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 6/4/18
 * Time: 12:20 PM
 */

namespace Glib\Models;


class Feature extends BaseModel
{
    protected $table = "featureAble";

    public static function makeFeature(BaseModel $model)
    {
        self::upsart(["model" => $model->getTable(), "model_id" => $model->getId()]);
    }

    public static function deleteFeature(BaseModel $model)
    {
        return self::whereModel($model->getTable())->whereModelId($model->getId())->delete();
    }

    public static function get(BaseModel $model)
    {
        return self::whereModel($model->getTable())->whereModelId($model->getId())->first();
    }
}