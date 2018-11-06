<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 12/04/18
 * Time: 12:25 م
 */

namespace Glib\UMS\Middleware;


use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class SharedVars
{
    public function handle(Request $request, \Closure $next)
    {
        /** @var Route $route */
        $route = $request->route();

        $scope =explode("/", trim($route->getPrefix() ?? "front", "/"))[0];

        try {
            /** @var Controller $controller */
            $controller = $route->getController();
            $module = Str::slug(Str::snake($controller->getName()->getShortName()->asPlainText()));
//            dd($module);
        } catch (\Exception $g) {
            $module = "";
//            dd($module);
        }

        Controller::setVars($scope, $module);

        return $next($request);

    }
}