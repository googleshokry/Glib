<?php

namespace Glib\UMS\Contracts;


/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 11:16 ص
 */
interface ScopeConfig
{
    public function loginUrl(): string;

    public function scopeName(): string;

    public function dashboardUrl(): string;

    public function logoutUrl(): string;

    public function registerUrl(): string;

    public function forgetPasswordUrl(): string;

    public function userModel(): Authenticatable;

    public function getActiveUrl($base64_encode);

    public function profileUrl(): string;
}