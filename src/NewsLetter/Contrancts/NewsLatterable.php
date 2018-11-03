<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 11:23 ص
 */

namespace Glib\NewsLetter\Contracts;


/**
 * Interface NewsLatterable
 * @package Glib\NewsLetter\Contracts
 */
interface NewsLatterable
{
    /**
     * @param null $list
     * @param bool $isPending
     * @return mixed
     */
    public function subscribe($list = null, $isPending = false);

    /**
     * @return mixed
     */
    public function unSubscribe();

    /**
     * @param null $list
     * @return mixed
     */
    public function subscribePending($list = null);

    /**
     * @param $newEmail
     * @return mixed
     */
    public function updateEmailAddress($newEmail);



    /**
     * @return mixed
     */
    public function isSubscribed();
}