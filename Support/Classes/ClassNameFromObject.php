<?php

namespace Glib\Support\Classes;

use Glib\Support\Text;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 12/04/18
 * Time: 12:39 م
 */
class ClassNameFromObject
{
    private $obj;


    public static function make($obj)
    {
        return new static($obj);
    }

    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    public function getFullName()
    {
        return get_class($this->obj);
    }

    public function getShortName(): Text
    {
        $p = explode("\\", $this->getFullName());
        return Text::make(end($p));
    }
}