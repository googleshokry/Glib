<?php

namespace Glib\Validations\Rules;

use Illuminate\Validation\Validator;
use Glib\Validations\BaseRules;
use Glib\Validations\Contracts\ValidationCustomRule;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 26/04/18
 * Time: 03:35 م
 */
class IsPhone extends BaseRules implements ValidationCustomRule
{

    public function handel($attribute, $value, $parameters, Validator $validator): bool
    {
        return is_numeric($value);
    }


}