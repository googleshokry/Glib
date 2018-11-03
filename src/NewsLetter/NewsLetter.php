<?php

namespace Glib\NewsLetter;

use Glib\NewsLetter\Contracts\NewsLatterable;

use Glib\NewsLetter\Model\NewsLetter as NewsLetterModel;


class NewsLetter implements NewsLatterable
{

    public static function make($email){
        return new static($email);
    }

    /**
     * @var
     */
    private $email;


    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @param null $list
     * @param bool $isPending
     * @return mixed
     */
    public function subscribe($list = null, $isPending = false)
    {
        return NewsLetterModel::createOrUpdate($this->email, $list ?? "default", $isPending);
    }

    /**
     * @return mixed
     */
    public function unSubscribe()
    {
        NewsLetterModel::whereEmail($this->email)->deactivate();
    }

    /**
     * @param null $list
     * @return mixed
     */
    public function subscribePending($list = null)
    {
        return $this->subscribe($list, true);
    }

    /**
     * @param $newEmail
     * @return NewsLetterModel
     */
    public function updateEmailAddress($newEmail)
    {
        return NewsLetterModel::whereEmail($this->email)->updateEmail($newEmail);
    }


    /**
     * @return bool
     */
    public function isSubscribed(): bool
    {
        return (NewsLetterModel::whereEmail($this->email)->first()) ? true : false;
    }



}