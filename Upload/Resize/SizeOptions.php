<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 09:01 م
 */

namespace Glib\Upload\Resize;

/**
 * Description of SizeOptions
 *
 * @author jooAziz
 */
class SizeOptions {

    private static $typeCrop = 'crop';
    private static $typeResize = 'resize';
    private $type;
    private $quality;
    private $width;
    private $height;

    /**
     * SizeOptions constructor.
     * @param $width
     * @param null $height
     * @param int $quality
     */
    public function __construct($width, $height = null, $quality = 90) {
        $this->quality = $quality;
        $this->type = self::$typeResize;
        $this->width = $width;
        $this->height = (is_null($height)) ? $width : $height;
    }

    /**
     * @return $this
     */
    public function setTypeToCrop() {
        $this->type = self::$typeCrop;
        return $this;
    }

    /**
     * @return $this
     */
    public function setTypeToResize() {
        $this->type = self::$typeResize;
        return $this;
    }

    /**
     * @param $quality
     * @return $this
     */
    public function setQuality($quality) {
        $this->quality = $quality;
        return $this;
    }

    /**
     * @param $width
     * @return $this
     */
    public function setWidth($width) {
        $this->width = $width;
        return $this;
    }

    /**
     * @param $height
     * @return $this
     */
    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     *
     * @return int
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     *
     * @return int
     */
    public function getQulity() {
        return $this->quality;
    }

    /**
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

}