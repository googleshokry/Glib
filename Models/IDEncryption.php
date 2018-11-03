<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 5/14/18
 * Time: 5:06 PM
 */

namespace Glib\Models;


use function GuzzleHttp\Psr7\str;

class IDEncryption
{
    private $id;

    private $fix = 4036;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function encryptId()
    {
//        $min = pow(10, $this->digits - 1);
//        $max = pow(10, $this->digits) - 1;
//        return (int)(mt_rand($min, $max) . $id);
        $id = ($this->id * $this->fix);
        return (int)($this->fix . $id);
    }

    public function decryptId()
    {
        $id = substr($this->id, strlen($this->fix));

        return $id / $this->fix;
    }


}