<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 12:07 م
 */

namespace Glib\Controllers;


/**
 * Class Redirect
 * @package Glib\Controllers
 */
class Redirect
{
    /**
     * @var
     */
    private $module;
    /**
     * @var string
     */
    private $scope;

    /**
     * @param $module
     * @param string $scope
     * @return static
     */
    public static function make($module, $scope = '')
    {
        return new static($module, $scope);
    }

    /**
     * Redirect constructor.
     * @param $module
     * @param string $scope
     */
    public function __construct($module, $scope = '')
    {
        $this->module = $module;
        $this->scope = $scope;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return $this->route("index");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return $this->route("create");
    }

    /**
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id = null)
    {
        return $this->route("edit", [$this->module => $id]);
    }

    /**
     * @param $route
     * @param array $parameters
     * @return \Illuminate\Http\RedirectResponse
     */
    public function route($route, $parameters = [])
    {

        return redirect()->route("$this->scope.$this->module.$route", array_merge($parameters, request()->query()));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function basedOnRequest()
    {
        return $this->route(request()->_submit ?? "index");
    }

}