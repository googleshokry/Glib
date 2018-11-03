<?php

namespace Glib\Support\Contract;
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 01:55 م
 */

interface StatusInterface
{
    public function setStatus(bool $status);

    public function getStatus(): bool;

    public function setMessage(string $message);

    public function getMessage(): string;

    public function setLevel(string $level);

    public function getLevel(): string;
}