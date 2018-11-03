<?php

namespace Glib\FeatureAble\Traits;


use Illuminate\Database\Eloquent\Builder;
use Glib\Models\Feature;


trait FeatureAbleTrait
{
    public static function getFeatured(): Builder
    {
        return self::whereIn("id", Feature::whereModel((new static())->getTable())->pluck("model_id")->toArray());
    }

    public static function getunFeatured(): Builder
    {
        return self::whereNotIn("id", Feature::whereModel((new static())->getTable())->pluck("model_id")->toArray());
    }

    public function isFeature(): bool
    {
        return (Feature::get($this)) ? true : false;
    }

    public function unFeature(): void
    {
        Feature::deleteFeature($this);
    }

    public function makeMeFeatured(): void
    {
        Feature::makeFeature($this);
    }

    public function changeFeatureStatus(): void
    {
//        dd(request()->all());
        if (request()->exists("feature") && request()->get("feature") == "on") {
            $this->makeMeFeatured();
        } else {
            $this->unFeature();
        }
    }

    public function reverseFeatureStatue(): void
    {
        ($this->isFeature()) ? $this->unFeature() : $this->makeMeFeatured();
    }
}