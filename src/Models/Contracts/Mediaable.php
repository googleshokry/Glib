<?php

namespace Glib\Models\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 08:38 م
 */
interface MediaAble
{
    const single = "single";
    const multi = "multi";

    public function getMediaFiles(): array;

    public function updateMedia(Request $request = null);

    public function getMedia();

    /**
     * @return Collection
     */
    public function getLinkedMedia();

    public function deleteImageFile();
}