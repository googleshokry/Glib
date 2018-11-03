<?php

namespace Glib\SEO\Contracts;
use Glib\Models\Seo;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 03:57 م
 */

interface SEOable
{
    public function seo();

    public function updateSeoRecord();

    public function deleteSeo();

    public function getSeo(): ?Seo;
}