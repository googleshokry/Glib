<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 6/5/18
 * Time: 11:33 AM
 */

namespace Glib\Controllers;


trait FeatureTrait
{
    public function feature($id)
    {
        $this->getRepo()->getModel()->FBEncryptedId($id)->reverseFeatureStatue();
        return response()->json(["status" => true]);
    }
}