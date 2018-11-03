<?php

namespace Glib\Tag\Contracts;
use Glib\Models\Tag;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 03:57 م
 */

interface Tagable
{
    public function tag();

    public function updateTagRecord();

    public function deleteTag();

    public function getTags();
}