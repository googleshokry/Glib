<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 03:36 م
 */

namespace Glib\UMS;

use Glib\UMS\Middleware\SharedVars;
use Route;
use Glib\UMS\Middleware\GustedMiddleware;
use Glib\UMS\Middleware\UserMiddleware;

class AuthRoute
{

    private $prefix;
    private $scopeClass;
    private $authClass;
    private $isForAdmin = false;

    public function addPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function addScopeClass($scopeClass)
    {
        $this->scopeClass = $scopeClass;
        return $this;
    }

    public function addAuthClass($authClass)
    {
        $this->authClass = $authClass;
        return $this;
    }

    public function makeItAdminRoute()
    {
        $this->isForAdmin = true;
        return $this;
    }

    public function route(\Closure $callback = null)
    {
        $authClass = "\\" . ltrim($this->authClass, "\\");
        $scopeClass = $this->scopeClass;
        $prefix = $this->prefix;


        Route::group(["prefix" => $prefix], function () use ($scopeClass, $authClass, $callback) {


            Route::group(["prefix" => "auth"], function () use ($scopeClass, $authClass) {
                Route::group(["middleware" => GustedMiddleware::class . ":" . $scopeClass], function () use ($authClass) {
                    Route::get('/', function () {
                        return UMS::instance()->redirectTo()->login();
                    });
                    Route::get('/login', $authClass . "@getLogin");
                    Route::post('/login', $authClass . "@postLogin");

                    Route::get('/register', $authClass . "@getRegister");
                    Route::post('/register', $authClass . "@postRegister");

                    Route::get('/forget-password', $authClass . "@getForgetPassword");
                    Route::post('/forget-password', $authClass . "@postForgetPassword");



                    Route::get('/active', $authClass . "@activeUser");
                });
                Route::group(["middleware" => UserMiddleware::class . ":" . $scopeClass], function () use ($authClass) {
                    Route::get('/dashboard', function () {
                        return UMS::instance()->redirectTo()->dashboard();
                    });

                    Route::get('/logout', $authClass . "@getLogout");
                });
            });

            Route::group(["middleware" => UserMiddleware::class . ":" . $scopeClass], function () use ($authClass, $callback) {

                Route::get('/', function () {
                    return UMS::instance()->redirectTo()->dashboard();
                });
                if (!is_null($callback))
                    $callback();

            });
        });
    }

    public static function make()
    {
        return new static();
    }
}