<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 03:23 م
 */

namespace Glib\UMS;


class RedirectTo
{
    /**
     * @var UMS
     */
    private $UMS;

    public function __construct(UMS $UMS)
    {
        $this->UMS = $UMS;
    }

    public function login()
    {
        return redirect($this->UMS->getScopeConfig()->loginUrl());
    }

    public function dashboard()
    {
        return redirect($this->UMS->getScopeConfig()->dashboardUrl());
    }
}