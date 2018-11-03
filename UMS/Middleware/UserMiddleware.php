<?php

namespace Glib\UMS\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Glib\Logging\ActivityLog;
use Glib\UMS\Contracts\Authenticatable;
use Glib\UMS\Contracts\ScopeConfig;
use Glib\UMS\UMS;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 11:16 ص
 */
class UserMiddleware
{
    public function handle(Request $request, \Closure $next, $prefix = null)
    {

//dd(session()->get(null));

        $ums = UMS::instance(new $prefix)->setLogging(new ActivityLog());


        if ($ums->isLogin())
            return $next($request);

        redirect($ums->getScopeConfig()->loginUrl())->send();
    }
}