<?php

namespace Glib\Review\Traits;

use Glib\Models\Review;
use Glib\UMS\UMS;

/**
 * Trait ReviewTrait
 * @package Glib\Review\Traits
 */
trait ReviewTrait
{
    /**
     * @var
     */
    protected $myReviewObj;

    public function review()
    {
        return $this->hasMany(Review::class, "model_id")->whereModel($this->getTable());
    }

    public function deleteReview()
    {
        return Review::whereModel($this->getTable())->whereModelId($this->getId())->delete();
    }


    public function getReview()
    {
//        dd($this->review);
        if (!$this->myReviewObj)
            $this->myReviewObj = $this->review;

        return $this->myReviewObj;
    }

    public function updateReviewRecord()
    {
        // todo :: check edit
        Review::upsart(
            [
                "model" => $this->getTable(),
                "model_id" => $this->id,
                "user_id" => UMS::instance()->getUser()->getId(),
                "user" => UMS::instance()->getUser()->getClass(),
            ],
            [
                "rate" => request()->rate,
                "comment" => request()->comment,
            ]
        );

    }
}