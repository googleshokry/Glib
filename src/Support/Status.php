<?php

namespace Glib\Support;

use Glib\Support\Contract\StatusInterface;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 02:02 م
 */
class Status implements StatusInterface
{
    private $status;
    private $message;
    private $level;

    public static function make(string $message = "", bool $status = false, string $level = "error")
    {
        return new static($message, $status, $level);
    }

    public function __construct(string $message = "", bool $status = false, string $level = "error")
    {
        $this->message = $message;
        $this->status = $status;
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus(bool $status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel(string $level)
    {
        $this->level = $level;
    }


}