<?php

namespace Glib\Review;

use Glib\Review\Contracts\Reviewable;
use Glib\Support\Text;

/**
 * Class ReviewViewer
 * @package Glib\Review
 */

class ReviewViewer
{
    private static $_instance;
    /**
     * @var float
     */
    private $rate;
    /**
     *
     * @var string
     */
    private $comment;


    public static function viewFromReviewableObject(Reviewable $Reviewable)
    {
        $review = $Reviewable->getReview();
        return self::instance($review->getRate(),$review->getComment());
    }

    public static function instance( $rate = 0, $comment = "")
    {
        if (!self::$_instance)
            self::$_instance = new  static();


        return self::$_instance->setComment($comment)->setRate($rate);

    }

    /**
     *
     * @return static
     */
    public static function getInstance()
    {
        return self::$_instance ?? new static();
    }

    private function __construct($rate = 0, $comment = "")
    {
        $this->rate = $rate;
        $this->comment= $comment;
    }


    /**
     *
     * @return float|int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     *
     * @param $rate
     * @return $this
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @return Text
     */
    public function getComment(): Text
    {
        return Text::make($this->comment);
    }

    /**
     *
     * @param string $comment
     * @return $this
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;
        return $this;
    }


}