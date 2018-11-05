<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 05/11/2018
 * Time: 05:37 ص
 */

if (!function_exists("dimensions")) {

    function dimensions($w = null, $h = null, $m = 2)
    {
        return new \App\Helpers\Dimensions($w, $h, $m);
    }
}

if (!function_exists("dimensionsPag")) {

    function dimensionsPag()
    {
        return new \App\Helpers\DimensionsPag();
    }
}