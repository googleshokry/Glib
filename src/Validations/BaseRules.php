<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 27/04/18
 * Time: 11:29 ص
 */

namespace Glib\Validations;


use Illuminate\Validation\Validator;
use Glib\Support\Classes\ClassNameFromObject;
use Glib\Validations\Contracts\ValidationCustomRule;

abstract class BaseRules implements ValidationCustomRule
{
    abstract public function handel($attribute, $value, $parameters, Validator $validator): bool;

    public function getRuleName(): string
    {
        return (new ClassNameFromObject($this))->getShortName();
    }
}