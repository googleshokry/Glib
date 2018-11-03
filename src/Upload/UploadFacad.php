<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Glib\Upload;


use Illuminate\Support\Collection;

/**
 * Description of UploadFacad
 *
 * @author Eng Shokry
 */


class UploadFacad {

    /**
     * @param $files
     * @param array $size
     * @return mixed
     */
    public static function uploadWithResize($files, $size = []) {

        $uploadHandler = UploadAndResize::uploadRequestFiled($files);

        if (is_array($size) && !empty($size)) {
            $uploadHandler->resize(ResizeBuldirFacad::fromArray($size));
        }
        return $uploadHandler->getNames();
    }

    /**
     * @param $files
     * @return Collection
     */
    public static function justUpload($files) {
        $uploadHandler = UploadAndResize::uploadRequestFiled($files);
        return $uploadHandler->getNames();
    }

}
