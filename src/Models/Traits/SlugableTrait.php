<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 28/04/18
 * Time: 11:36 ص
 */

namespace Glib\Models\Traits;


use Glib\Models\Contracts\Slugable;
use Glib\Support\Text;

trait SlugTrait
{
    abstract public function getTitle():Text;

    public function makeSlug()
    {
        $reqSlug = request()->get("slug");

        $slug = ($reqSlug) ? $reqSlug : (($this->slug) ? $this->slug : $this->getTitle());

        $this->slug = str_slug($slug);
    }

    /**
     * @return mixed
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    public static function findBySlug(string $slug): ?Slugable
    {
        return self::where("slug", $slug)->first() ?? abort(404);
    }

    public function slugAbleLink(): string
    {
        return route("front." . str_plural($this->getTable()) . ".details", ["slug" => $this->getSlug()]);
    }
}