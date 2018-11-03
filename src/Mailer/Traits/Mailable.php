<?php

namespace Glib\Mailer\Traits;


use Glib\Mailer\Contracts\MailableInterface;
use Glib\Mailer\EmailLogging;
use Glib\UMS\Contracts\Authenticatable;

/**
 * Trait Mailable
 * @property  MailableInterface $this
 * @package Glib\Mailer\Traits
 */
abstract class Mailable
{
    /**
     * @var Authenticatable
     */
    protected $user;
    protected $subject;
    protected $template = "template_name";
    protected $attributes = [];


    /**
     * @param $subject
     * @return MailableInterface
     */
    public function setSubject($subject): MailableInterface
    {
        $this->subject = $subject;
        /** @var MailableInterface $this */
        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setTemplate($template): MailableInterface
    {
        $this->template = $template;
        /** @var MailableInterface $this */
        return $this;
    }

    public function getEmail(): string
    {
        return $this->user->getEmail();
    }

    public function getName(): string
    {
        return $this->user->getName();
    }


    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $data): MailableInterface
    {
        $this->attributes = $data;
        /** @var MailableInterface $this */
        return $this;
    }

    public function send(\Closure $callback = null)
    {
        $email = (new EmailLogging)
            ->setSubject($this->getSubject())
            ->setTemplate($this->getTemplate())
            ->setData($this->getAttributes())
            ->setUserEmail($this->getEmail())
            ->setUserName($this->getName())
            ->send();

        $log = $email->log();

        if (is_callable($callback))
            $callback($email, $log);
    }

    /**
     * @return Authenticatable
     */
    public function getUser(): Authenticatable
    {
        return $this->user;
    }

    /**
     * @param Authenticatable $user
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }

}
