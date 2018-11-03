<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 11:23 ص
 */

namespace Glib\Mailer\Contracts;


interface MailMEInterFace
{
    public function mailMe(): MailableInterface;
}