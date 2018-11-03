<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 08:59 م
 */

namespace Glib\Upload\Resize;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Collection;


/**
 * Description of Resize
 *
 * @author jooAziz
 */
class ResizeBulider
{

    private $sizesList;

    /**
     * @param SizeOptions $sizeClass
     * @return $this
     */
    public function addSize(SizeOptions $sizeClass)
    {
        $this->sizesList[] = $sizeClass;
        return $this;
    }

    /**
     * @return Collection
     */
    public function bilud()
    {
        return Collection::make($this->sizesList);
    }

}