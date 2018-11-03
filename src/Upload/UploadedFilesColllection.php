<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Glib\Upload;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class UploadedFilesColllection
 * @package Glib\Upload
 */
class UploadedFilesColllection
{

    private $files;

    /**
     * UploadedFilesColllection constructor.
     * @param $files
     */
    public function __construct($files)
    {

        $filesArray = [];

        if ($files instanceof UploadedFile) {
            $filesArray = [$files];
        } elseif (is_array($files) && isset($files[0]) && ($files[0] instanceof UploadedFile)) {
            $filesArray = $files;
        }

        $this->files = Collection::make($filesArray);
    }

    /**
     * @return Collection
     */
    public function get()
    {
        return $this->files;
    }

}
