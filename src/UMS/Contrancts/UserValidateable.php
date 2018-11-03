<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 02:06 م
 */

namespace Glib\UMS\Contracts;


interface UserValidateable
{
    public function login(): array;

    public function register(): array;

    public function forgetPassword(): array;
}