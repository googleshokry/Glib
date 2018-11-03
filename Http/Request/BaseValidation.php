<?php

namespace Glib\Http\Request;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Glib\Controllers\AbstractRepo;
use Glib\Models\BaseModel;

/**
 * Description of BaseValidation
 *
 * @author jooaziz
 */
Abstract class BaseValidation
{
    public $id;
    public static function make($id = null)
    {
        return new static($id );
    }

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function validate()
    {

        /**
         * @var Validator $validator
         */

        $validator = \Validator::make(request()->all(), $this->rules());

        if ($validator->fails()) {
            return redirect()->back()->send()->withErrors($validator->errors())->withInput(request()->all())->send();
            die;
        }

        return $this;

    }

    /**
     * @var
     */
    protected $myUrl;

    /**
     * @return array
     */
    abstract protected function validateCreate(): array;

    /**
     * @return string
     */
    abstract protected function currentRoute(): string;

    /**
     * @return AbstractRepo
     */
    abstract public function getRepo(): AbstractRepo;

    public function save(): BaseModel
    {
        return $this->getRepo()->create();
    }

    /**
     * @param $id
     * @return bool
     */
    public function update($id): bool
    {
        return $this->getRepo()->update($id);
    }


    /**
     * @return array
     */
    abstract protected function validateEdit(): array;


    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * @return array
     */
    public function rules()
    {

        if ($this->isMethod("POST"))
            return $this->validateCreate();

        if ($this->currentRouteIs('/*') && $this->isMethod("PUT"))
            return $this->validateEdit();


        return [];
    }

    /**
     * @param string $route
     * @return bool
     */
    protected function currentRouteIs($route = ""): bool
    {
        return $this->is($this->currentRoute() . $route);
    }

    public function is(...$pattern)
    {
        return $this->request()->is($pattern);
    }

    public function isMethod($method)
    {
        return $this->request()->isMethod($method);
    }

    public function request()
    {
        return request();
    }
}
