<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 6/6/18
 * Time: 10:54 AM
 */

namespace Glib\Models\Helper;


use Glib\Models\BaseModel;
use Glib\Models\Contracts\Slugable;

class URLs
{
    private $module;
    private $slug;

    public function __construct($module, $slug = null)
    {

        if (is_string($module) && !is_null($slug)) {
            $this->$module = $module;
            $this->slug = $slug;
        } elseif ($module instanceof BaseModel && $module instanceof Slugable) {
            $this->$module = str_plural($module->getTable());
            $this->slug = $module->getSlug();
        }
    }

    public function frontUrl()
    {
        return route("front.$this->module.details", ["slug" => $this->slug]);
    }
}