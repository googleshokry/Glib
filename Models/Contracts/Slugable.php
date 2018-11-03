<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 23/04/18
 * Time: 12:05 م
 */

namespace Glib\Models\Contracts;


interface Slugable
{
    public function getTitle();

    public function makeSlug();

    public function getSlug();

    public function slugAbleLink(): string;

    public static function findBySlug(string $slug): ?Slugable;
}