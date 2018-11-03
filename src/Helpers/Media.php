<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 22/04/18
 * Time: 12:16 م
 */


if (!function_exists("getMediaFile")) {

    function getMediaFile($filePath)
    {


        return new \Glib\Upload\MediaFile($filePath);
    }
}