<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 01:17 م
 */

namespace Glib\UMS\Middleware;


use Illuminate\Http\Request;
use Glib\Logging\ActivityLog;
use Glib\UMS\UMS;

class GustedMiddleware
{
    public function handle(Request $request, \Closure $next, $prefix = null)
    {

//dd(session()->get(null));

        $ums = UMS::instance(new $prefix)->setLogging(new ActivityLog());


        if ($ums->isLogin())
            redirect($ums->getScopeConfig()->dashboardUrl())->send();

        return $next($request);
    }
}