<?php

namespace Glib\Review\Contracts;
use Glib\Models\Review;

/**
 * Interface Reviewable
 * @package Glib\Review\Contracts
 */

interface Reviewable
{
    public function review();

    public function updateReviewRecord();

    public function deleteReview();

    public function getReview();
}