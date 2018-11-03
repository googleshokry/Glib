<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 05:23 م
 */

namespace Glib\Models;


use Glib\Support\StringToArray;
use Glib\Support\Text;

class Seo extends BaseModel
{


    protected $table = "seo";

    /**
     * @return StringToArray
     */
    public function getKeyWords()
    {
        return new StringToArray($this->keywords);
    }

    /**
     * @return Text
     */
    public function getDescription()
    {
        return new Text($this->description);
    }
}