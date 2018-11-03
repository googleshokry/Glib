<?php

namespace Glib\Controllers;

use Glib\Support\Classes\ClassNameFromObject;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 18/04/18
 * Time: 05:15 م
 */
trait GlibHelperController
{
    /**
     * @var
     */
    protected static $_module;
    /**
     * @var
     */
    protected static $_scope;

    /**
     * @param $scope
     * @param $module
     */
    public static function setVars($scope, $module)
    {
//        dd($scope,$module);
        self::$_scope = $scope;
        self::$_module = $module;
    }

    /**
     * @return ClassNameFromObject
     */
    public function getName()
    {
        return new ClassNameFromObject($this);
    }

    /**
     * @param array $data
     * @param null $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view(array $data = [], $view = null)
    {
        $action = request()->route()->getActionMethod();

        $data["scope"] = self::$_scope;
        $data["module"] = self::$_module;

        $activeView = $view ?? (self::$_scope . "." . self::$_module . "." . $action);

        return view($activeView, $data);
    }

    /**
     * @return Redirect
     */
    public function redirectTo()
    {
        return Redirect::make(self::$_module,self::$_scope);
    }
}