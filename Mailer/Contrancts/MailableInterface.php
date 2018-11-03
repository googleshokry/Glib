<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 11:23 ص
 */

namespace Glib\Mailer\Contracts;


interface MailableInterface
{
    public function send(\Closure $callback = null);

    public function setSubject($subject): MailableInterface;

    public function getSubject(): string;

    public function setTemplate($template): MailableInterface;

    public function getTemplate(): string;

    public function getEmail(): string;

    public function getName(): string;

    public function getAttributes(): array;

    public function setAttributes(array $data): MailableInterface;
}