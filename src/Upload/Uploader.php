<?php

namespace Glib\Upload;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



use Illuminate\Support\Collection;
use Glib\Support\UUID;

/**
 * Description of Uploader
 *
 * @author Eng Shokry
 */
class Uploader {

    private $uploadesFilesList = [];
    private $uploadList;

    public function __construct(UploadedFilesColllection $files) {
        $this->uploadesFilesList = Collection::make();
        $this->uploadList = $files->get();
    }

    /**
     * @return Collection
     */
    public function get() {
        foreach ($this->uploadList->all() as $oneFile) {
            $this->uploadesFilesList->push(self::runUploda($oneFile));
        }
        return $this->uploadesFilesList;
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    private static function runUploda(\Illuminate\Http\UploadedFile $file) {
        $filename = UUID::uniqeFileName() . '.' . strtolower($file->getClientOriginalExtension());
        $file->move(Conf::getUploadDir(), $filename);
//        dd($filename);
        return $filename;
    }

}
