<?php

namespace Glib\FeatureAble\Contracts;

use Illuminate\Database\Eloquent\Builder;


/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 03:57 م
 */
interface FeatureAble
{
    public static function getFeatured(): Builder;

    public function isFeature(): bool;

    public function unFeature(): void;

    public function changeFeatureStatus(): void;

    public function makeMeFeatured(): void;

    public function reverseFeatureStatue(): void;
}