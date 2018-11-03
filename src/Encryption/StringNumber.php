<?php

namespace Glib\Encryption;

use function GuzzleHttp\Psr7\str;
use Glib\Math\MathBase;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 6/11/18
 * Time: 12:45 PM
 */
class StringNumber
{
    private static $base = '0123456789 abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ _=+)({}\"-*.%$/' . "'";
    private static $fix = 10;
    private static $preFix = "c";



    public static function encrypt($string)
    {
        $return = "";

        $len = strlen($string);
        for ($i = 0; $i < $len; $i++)
            $return .= (self::charToPosition($string[$i]));


        return ($return);

    }

    public static function decrypt($string)
    {

        $rt = "";
        $lis = str_split($string, strlen(self::$fix));
        foreach ($lis as $pos)
            $rt .= self::positionToChar($pos);
        return $rt;

    }

    public static function charToPosition($chr)
    {

        $pos = strpos(self::$base, $chr);

        if ($pos === false)
            throw new \Exception("unsupported chars");


        return ($pos + self::$fix);

    }

    public static function positionToChar($position)
    {

        return self::$base[$position - self::$fix];
    }

}