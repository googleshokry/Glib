<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 12/04/18
 * Time: 01:06 م
 */


if (!function_exists("auther")) {
    /**
     * @return \Glib\UMS\UMS
     */
    function auther()
    {
        return \Glib\UMS\UMS::instance();
    }
}


if (!function_exists("customerAuther")) {
    /**
     * @return \Glib\UMS\UMS
     */
    function customerAuther()
    {
        return \Glib\UMS\UMS::instance(new \App\ScopesConfigs\CustomerScope);
    }
}



if (!function_exists("loggingUser")) {
    /**
     * @return \Glib\UMS\Contracts\Authenticatable
     */
    function loggingUser()
    {
        return auther()->getUser();
    }
}

