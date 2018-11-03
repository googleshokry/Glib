<?php

namespace Glib\Upload\Resize;


class ResizeBuldirFacad {

    /**
     * @param $size
     * @return ResizeBulider
     */
    public static function fromArray($size) {
        $bulider = new ResizeBulider();

        if (is_array($size) && !empty($size)) {
            foreach ($size as $oneSize) {
                $sizeOprionsAttr = explode(',', $oneSize);
                $sizeOptionClass = new SizeOptions($sizeOprionsAttr[1]); //width
                $sizeOptionClass->setHeight($sizeOprionsAttr[2]); //height
                ($sizeOprionsAttr[0] == 'crop') ? $sizeOptionClass->setTypeToCrop() : $sizeOptionClass->setTypeToResize(); //type
                $bulider->addSize($sizeOptionClass);
            }
        }
        return $bulider;
    }

}