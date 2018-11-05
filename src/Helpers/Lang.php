<?php
/**
 * Created by PhpStorm.
 * User: Senior Eng Shokry Back End Develper
 * Date: 20/06/18
 * Time: 12:07 م
 */


if (!function_exists("check_lang")) {

    function check_lang()
    {
        if (in_array(Request::segment(1), ['en', 'ar'])) {
            App::setLocale(Request::segment(1));
        } else {
            // set default / fallback locale
            App::setLocale('ar');
        }
        return App::getLocale();
    }
}