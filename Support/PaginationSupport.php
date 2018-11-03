<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 5/9/18
 * Time: 3:11 PM
 */

namespace Glib\Support;


class PaginationSupport
{

    private static $limit = 10;

    public static function getLimit($limit = null)
    {


        $limit = (int)($limit ?? (request()->get("limit") ?? self::$limit));
        return ($limit <= 0 || $limit > 500) ? self::$limit : $limit;

    }
}