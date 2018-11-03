<?php

namespace Glib\Http\Routes;

use Route;

class RoutesWrapper
{

    private $name;
    private $controller;

    /**
     * @var string
     */
    private $scope;

    public function __construct($name, $controller, $scope = "")
    {
        $this->name = $name;
        $this->controller = $controller;

        $this->scope = $scope;
    }

    public function resource(array $only = null)
    {
        $options = [];


        if ($this->scope != "front")
            $options["as"] = $this->scope;


        if (is_null($only)) {
            Route::resource($this->name, $this->controller, $options);
        } else {
            Route::resource($this->name, $this->controller, $options)->only($only);
        }

        return $this;
    }

    public function statusAble()
    {
        Route::patch("$this->name/{id}/statuses", $this->controller . '@statuses')->name("$this->scope.$this->name.statuses");
        return $this;
    }

    public function featureAble()
    {
        Route::post($this->name . '/{id}/feature', $this->controller . '@feature')->name("$this->scope.$this->name.feature");
        return $this;
    }

    public function slugAble()
    {
        Route::get($this->name . "/{slug}", $this->controller . "@details")->name("$this->scope.$this->name.details");
        return $this;
    }

    public function index()
    {
        Route::get("$this->name", $this->controller . "@index")->name("$this->scope.$this->name.index");
        return $this;
    }


    public function get($action)
    {
        Route::get("$this->name/$action", $this->controller . "@" . $action)->name("$this->scope.$this->name.$action");
        return $this;
    }

    public function post($action)
    {
        Route::post("$this->name/$action", $this->controller . "@" . $action)->name("$this->scope.$this->name.$action");
        return $this;
    }
    public function put($action)
    {
        Route::put("$this->name/$action", $this->controller . "@" . $action)->name("$this->scope.$this->name.$action");
        return $this;
    }

    public function any($action)
    {
        Route::any("$this->name/$action", $this->controller . "@" . $action)->name("$this->scope.$this->name.$action");
        return $this;
    }


    public function custom($cb)
    {
        $cb($this->name, $this->controller, $this->scope);

        return $this;
    }


}