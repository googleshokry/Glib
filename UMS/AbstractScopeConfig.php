<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 15/04/18
 * Time: 05:14 م
 */

namespace Glib\UMS;


use Glib\UMS\Contracts\Authenticatable;
use Glib\UMS\Contracts\ScopeConfig;

abstract class AbstractScopeConfig implements ScopeConfig
{
    abstract protected function getScope(): string;

    abstract public function userModel(): Authenticatable;

    public function profileUrl(): string
    {
        return url($this->getScope() . "/profile");
    }

    public function loginUrl(): string
    {
        return url($this->getScope() . "/auth/login");
    }

    public function scopeName(): string
    {
        return $this->getScope();
    }

    public function dashboardUrl(): string
    {
        return url($this->getScope() . "/dashboard");
    }

    public function logoutUrl(): string
    {
        return url($this->getScope() . "/auth/logout");
    }


    public function registerUrl(): string
    {
        return $this->getScope() . "/auth/register";
    }

    public function forgetPasswordUrl(): string
    {
        return $this->getScope() . "/auth/forget-password";
    }

    public function getActiveUrl($base64_encode)
    {
        return url($this->getScope() . "/auth/active?_t=" . $base64_encode);
    }
}