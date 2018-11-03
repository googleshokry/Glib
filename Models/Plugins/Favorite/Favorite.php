<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 6/10/18
 * Time: 3:25 PM
 */

namespace Glib\Models\Plugins\Favorite;


use Glib\Models\BaseModel;
use Glib\UMS\Contracts\Authenticatable;

class Favorite extends BaseModel
{

    public static function add(Authenticatable $user, BaseModel $model)
    {

        self::upsart([
            "model_id" => $model->getId(),
            "model" => $model->getTable(),
            "user_id" => $user->getId(),
        ]);


    }

    public static function remove(Authenticatable $user, BaseModel $model)
    {
        (new static())
            ->where("model_id", $model->getId())
            ->where("model", $model->getTable())
            ->where("user_id", $user->getId())
            ->delete();
    }


    public static function lists(Authenticatable $user, BaseModel $model)
    {
        return (new static())
            ->where("model", $model->getTable())
            ->where("user_id", $user->getId())
            ->get();
    }

    public static function getForUserAndModel(Authenticatable $user, BaseModel $model)
    {

        return (new static())
            ->where("model", $model->getTable())
            ->where("model_id", $model->getId())
            ->where("user_id", $user->getId())
            ->get();

    }
}