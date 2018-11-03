<?php

namespace Glib\Math;
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 23/04/18
 * Time: 01:40 م
 */

class PrimaryFactory
{
    private $number;

    public static function make($number)
    {
        return new static($number);
    }

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function get()
    {
        $n = $this->number;
        $pf = array();
        for ($i = 2; $i <= $n / $i; $i++) {
            while ($n % $i == 0) {
                $pf[] = $i;
                $n = $n / $i;
            }
        }

        if ($n > 1) $pf[] = $n;
        return  $pf;

    }
}