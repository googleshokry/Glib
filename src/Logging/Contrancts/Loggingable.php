<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 11:23 ص
 */

namespace Glib\Logging\Contracts;


use Glib\Models\BaseModel;
use Glib\UMS\Contracts\Authenticatable;

interface Loggingable
{
    public function on( $model): Loggingable;

    public function by(Authenticatable $user): Loggingable;

    public function with(array $data): Loggingable;

    public function log(string $message): Loggingable;
}