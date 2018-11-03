<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Glib\Upload;

/**
 * Description of Bas64FileUploader
 *
 * @author server
 */
use Glib\Support\UUID;

class Bas64FileUploader
{

    private $imageData, $mime_type, $extension, $type;

    public function __construct($imageData)
    {

        $this->imageData = base64_decode($imageData);

        $this->mime_type = finfo_buffer(finfo_open(), $this->imageData, FILEINFO_MIME_TYPE);
        list($this->type, $this->extension) = explode('/', $this->getMimeType());
    }

    public function getType()
    {
        return $this->type;
    }

    public function getimageData()
    {
        return $this->imageData;
    }

    public function getMimeType()
    {
        return $this->mime_type;
    }

    public function getExtension()
    {

        return $this->extension;
    }

    public function save($dir = "uploads")
    {
        $fileName = UUID::v4() . '.' . $this->getExtension();
        $path = $dir . '/' . $fileName;
        file_put_contents($path, $this->imageData, 0777);
        return $fileName;
    }

}
