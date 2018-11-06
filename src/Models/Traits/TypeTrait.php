<?php
/**
 * Created by PhpStorm.
 * User: shokry
 * Date: 25/06/18
 * Time: 12:47 م
 */

namespace App\Models\Traits;


trait TypeTrait
{

    public function getTypes():int {
     return static::type;
    }
}