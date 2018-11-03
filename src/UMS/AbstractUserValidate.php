<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 05:05 م
 */

namespace Glib\UMS;


abstract class AbstractUserValidate
{
    public function login(): array
    {
        return [
            UMS::checkUser()->getLoginField() => "required|max:190",
            "password" => "required|max:190",
        ];
    }

    public function register(): array
    {
        return [
            "email" => "required|max:190",
            "password" => "required|max:190|min:8",
            "password_confirmation" => "required|same:password",
        ];
    }

    public function forgetPassword(): array
    {
        return [];
    }
}