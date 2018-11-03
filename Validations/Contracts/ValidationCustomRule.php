<?php

namespace Glib\Validations\Contracts;

use Illuminate\Validation\Validator;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 26/04/18
 * Time: 03:37 م
 */
interface ValidationCustomRule
{
    public function handel($attribute, $value, $parameters, Validator $validator): bool;

    public function getRuleName(): string;
}