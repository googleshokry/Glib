<?php

namespace Glib\Validations;

use Illuminate\Support\Facades\Validator;
use Glib\Support\Classes\ClassNameFromObject;
use Glib\Validations\Contracts\ValidationCustomRule;
use Glib\Validations\Rules\IsPhone;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 26/04/18
 * Time: 03:42 م
 */
class ValidationsRulesBoot
{
    const validations = [
        IsPhone::class
    ];


    public static function boot()
    {

        collect(self::validations)->each(function ($ruleClass) {

            $rule = new $ruleClass;


            if (!($rule instanceof ValidationCustomRule))
                throw new \Exception("class [$rule] must be instanceof " . ValidationCustomRule::class);

            Validator::extend($rule->getRuleName(), function ($attribute, $value, $parameters, $validator) use ($rule) {
                return $rule->handel($attribute, $value, $parameters, $validator);
            });
        });

    }
}