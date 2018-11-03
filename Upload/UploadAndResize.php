<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Glib\Upload;

/**
 * Description of UploadFacad
 *
 * @author jooAziz
 */

use Illuminate\Support\Collection;
use Glib\Upload\Resize\ResizeBulider;
use Glib\Upload\UploadedFilesColllection as UFC;


class UploadAndResize
{

    private $names;

    private function __construct($names)
    {
        $this->names = $names;
    }

    /**
     * @return mixed
     */
    public function getNames()
    {
        return $this->names;
    }

    public function resize(ResizeBulider $bulider)
    {
        Resizer::fromResizeBulider($bulider, $this->names);
        return $this;
    }

    /**
     * @param $files
     * @return static
     */
    public static function uploadRequestFiled($files)
    {
        return new static((new Uploader(new UFC($files)))->get());
    }


    /**
     * @param $fileds
     * @return Collection
     */
    public static function uploadMultiRequestFields($fileds)
    {
        $res = new Collection();
        foreach ($fileds as $fieldName => $field) {
            $res->put($fieldName, self::uploadRequestFiled($field));
        }

        return $res;
    }

}
