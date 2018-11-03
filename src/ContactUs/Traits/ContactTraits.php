<?php

namespace Glib\Contact\Traits;

use Illuminate\Http\Request;
use Glib\Contact\Tables;
use Glib\Models\Contact;
use PhpParser\JsonDecoder;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 05:25 م
 */
trait ContactTrait
{


    public static function getContact($type)
    {
       return static::JsonDesObj(self::where('type',$type)->select('content')->first());
    }

//    public function saveContact($request)
//    {
////        return static::quickSave([
////           'content'=>$this->JsonEnObj($request->all()),
////           'type'=>(int)$request->_table
////       ]);
//    }


    public function JsonEnObj($obj)
    {
        unset($obj['_token'],$obj['_submit'],$obj['_table'],$obj['g-recaptcha-response']);

        $data = json_encode($obj);
            return $data;
    }
    public static function JsonDesObj($obj)
    {
        $data = json_decode($obj['content']);
        return $data;
    }
    public static function getFields(string $table):array
    {
        return Tables::getFields($table);
    }
    public function getType()
    {
        return array_search($this->type, Tables::tables);
    }
    public function getContent()
    {
        $data = "<table>";

        foreach (self::JsonDesObj(['content' => $this->content]) as $k => $v)
        {
            $data .="<tr><td>".$k."</td><td>".$v."</td></tr>";
        }

        $data .= "</table>";

        return $data;
    }

}