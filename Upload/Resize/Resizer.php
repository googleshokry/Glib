<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 08:59 م
 */

namespace Glib\Upload\Resize;
use \Gumlet\ImageResize;

use Illuminate\Support\Collection;
use Glib\Upload\Conf;

/**
 * Description of Resizer
 *
 * @author jooAziz
 */
class Resizer {



    private function __construct() {

    }

    public static function fromResizeBulider(ResizeBulider $bulider, Collection $filesName) {
        $v = $bulider->bilud();
        foreach ($bulider->bilud()->all() as $option) {
            self::resizeOneByOne($option, $filesName->all());
        }
    }

    private static function resizeOneByOne(SizeOptions $option, $filesName) {
        $fullDirName = Conf::getUploadDir() . $option->getWidth() . 'x' . $option->getHeight().'/';
        (!\File::exists($fullDirName)) ? mkdir($fullDirName) : null;
        foreach ($filesName as $file) {
            $oldImageFullPath = Conf::getUploadDir() . $file;
            $image = new ImageResize($oldImageFullPath);
            $image->quality_jpg = $option->getQulity();
            $image->{$option->getType()}($option->getWidth(), $option->getHeight());
            $image->save($fullDirName . $file);
        }
    }

}