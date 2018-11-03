<?php
/**
 * Created by PhpStorm.
 * User: shokry
 * Date: 28/06/18
 * Time: 12:24 م
 */

namespace Glib\Upload;


use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection
{
    public function getAllAsImage(array $options)
    {

        $rt = "";
        /** @var MediaFile $item */
        foreach ($this->items as $item) {
            $rt .= $item->getAsImgTag($options);
        }

       return $rt;
    }
}