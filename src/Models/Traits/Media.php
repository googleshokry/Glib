<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 08:37 م
 */

namespace Glib\Models\Traits;

use File;

use Glib\Models\BaseModel;
use Glib\Models\Media;
use Glib\Upload\Conf;
use Glib\Upload\MediaCollection;
use Glib\Upload\MediaFile;
use Glib\Upload\UploadFacad;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 24/10/17
 * Time: 11:05 Ù…
 *
 *
 */
trait MediaAble
{

    private static $medisClass = Media::class;

    public function deleteImageFile()
    {
        foreach ($this->getMediaFiles() as $img => $type) {
            self::deleteOldOne($this->{$img});
        }
        return $this;
    }

    private static function deleteOldOne($file)
    {
        MediaFile::make($file)->delete();
    }

    private static function uploadFile(Request $request, $file, $type = "single")
    {
//dd($request, $file, $type,$request->file($file));
        if ($request->file($file))
            if ($type == "multi")
                $name = UploadFacad::justUpload($request->file($file))->all();
            else
                $name = UploadFacad::justUpload($request->file($file))->first();

        return $name;
    }

    public function updateMedia(Request $request = null)
    {


        $request = $request ?? request();

//        dd($this);
        $fields = $this->getMediaFiles();

        foreach ($fields as $name => $type) {

            if ($request->file($name)) {
                if ($type == "multi") {
                    self::$medisClass::insertNewMedia($this, self::uploadFile($request, $name, $type), "file type", $name);
                } else {
                    self::deleteOldOne($this->{$name});
                    $this->{$name} = self::uploadFile($request, $name);
                }
            }
        }

//dd("here");
        $this->save();

        return $this;
    }

    public function getLinkedMedia()
    {
        /** @var BaseModel $this */
        return Media::getLinkedMedia($this)->get();
    }

    /**
     * @return MediaCollection
     */
    public function getMedia()
    {
        /** @var \Glib\Models\Contracts\MediaAble $this */
        return new MediaCollection($this);
    }

}