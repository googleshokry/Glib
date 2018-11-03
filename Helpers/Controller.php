<?php

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 5/9/18
 * Time: 4:37 PM
 */


if (!function_exists("tableColumn")) {
    /**
     * @return \Glib\Controllers\TableColumn
     */
    function tableColumn()
    {
        return \Glib\Controllers\TableColumn::make();
    }
}


if (!function_exists("routeWrapper")) {
    /**
     * @param $name
     * @param $controller
     * @param $scope
     * @return \Glib\Http\Routes\RoutesWrapper
     */
    function routeWrapper($name, $controller, $scope)
    {
        return (new \Glib\Http\Routes\RoutesWrapper($name, $controller, $scope));

    }
}
function encryptId($id){
    return (new \Glib\Models\IDEncryption($id))->encryptId();
}

function decryptId($id){
    return (new \Glib\Models\IDEncryption($id))->decryptId();
}