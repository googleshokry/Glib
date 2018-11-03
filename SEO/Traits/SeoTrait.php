<?php

namespace Glib\SEO\Traits;

use Glib\Models\Seo;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 05:25 م
 */
trait SeoTrait
{
    protected $mySeoObj;

    public function seo()
    {
        return $this->hasOne(Seo::class, "model_id")->whereModel($this->getTable());
    }

    public function deleteSeo()
    {
        return Seo::whereModel($this->getTable())->whereModelId($this->getId())->delete();
    }


    public function getSeo(): ?Seo
    {
        if (!$this->mySeoObj)
            $this->mySeoObj = $this->seo;

        return $this->mySeoObj;
    }

    public function updateSeoRecord()
    {

        Seo::upsart(
            [
                "model" => $this->getTable(),
                "model_id" => $this->id
            ],
            [
                "keywords" => request()->seo_key,
                "description" => request()->seo_desc,
            ]
        );
    }
}