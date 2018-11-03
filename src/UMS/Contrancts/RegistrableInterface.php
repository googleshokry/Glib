<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 01:46 م
 */

namespace Glib\UMS\Contracts;


interface RegistrableInterface
{
    public function getActiveToken();

    public function registerNewUser(array $dataSource = null, \Closure $callback):?Authenticatable;

    public function activeMe($token, \Closure $callback = null);
}