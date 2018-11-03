<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 10:06 م
 */

namespace Glib\Upload;


use Illuminate\Http\UploadedFile;

class MediaFile
{
    public $name;
    /**
     * @var null
     */
    public $id;
    private $options = [];
    private $deleteAble = false;
    private static $isJSWrite = false;

    public static function make($name, $id = null)
    {
        return new static($name, $id);
    }

    public function __construct($name = null, $id = null)
    {

        $this->name = $name;
        $this->id = $id;
    }


    public function getFileName()
    {
        return $this->name;
    }

    public function getAsLinkTag($name = null, array $options = [])
    {

        $this->setOptions($options);
        return '<a href="' . $this->getFilePath() . '" ' . $this->getOptionsAsString() . ' >' . ($name ?? $this->getFileName()) . '</a>';
    }

    public function deleteAble()
    {
        $this->deleteAble = true;
        return $this;
    }


    public function getAsImgTag(array $options = [])
    {

        $options["data-id"] = encryptId($this->id);


        if (@$options["deleteAble"])
            $this->deleteAble();

        $imgTag = $this->makeImageTag($options);

        if (!$this->deleteAble)
            return $imgTag;


        $js = "";
        if (!self::$isJSWrite) {
            self::$isJSWrite = true;
            $js = '
            <script>
                function deleteImage(id) {
                  $.post("'.url("media/delete/").'/"+id, { _method: "DELETE", _token: "'.csrf_token().'" }, function(result) {
                       if(result.status)
                           location.reload()
                    });
                }          
            </script>
            
            ';

        }


        $formTag = '<button type="button" onclick="deleteImage(' . $this->id . ')" class="btn btn-danger" style="top: -12px;    border-radius: 17px;position: absolute;font-size: 10px;right: -14px;">X </button>';


        return '<div style="position: relative;display:inline-block;margin-left: 15px">' . $imgTag . $formTag . $js . '</div>';


    }


    private function makeImageTag(array $options)
    {
        $this->setOptions($options);
        return '<img ' . $this->getOptionsAsString() . ' src="' . $this->getFilePath() . '" />';
    }

    public function getFilePath($check = true)
    {
        if (filter_var($this->getFileName(), FILTER_VALIDATE_URL))
            return $this->getFileName();

        $fil = Conf::getUploadDir() . $this->getFileName();


        if ($check)
            return (\File::exists($fil) && !\File::isDirectory($fil)) ? $fil : "";

        return $fil;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    private function getOptionsAsString()
    {
//        v="asdsa"
        $rt = "";
        foreach ($this->options as $k => $v)
            $rt .= "$k=\"$v\" ";

        return $rt;

    }

    public function delete()
    {
        if (\File::exists($filePath = Conf::getUploadDir() . $this->name)) \File::delete($filePath);
    }

    public function replace(UploadedFile $file)
    {
        $this->delete();
        return UploadFacad::justUpload($file)->first();
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }
}