<?php

namespace Glib\Logging;

use Glib\Logging\Contracts\Loggingable;
use Glib\Models\BaseModel;
use Glib\UMS\Contracts\Authenticatable;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 16/04/18
 * Time: 10:42 ص
 */
class ActivityLog implements Loggingable
{
    private $engine;

    public function __construct()
    {
        $this->engine = activity();
    }

    public static function make()
    {
        return new static();
    }

    public function on($model): Loggingable
    {

        if ($model instanceof BaseModel)
            $this->engine->on($model);
        else
            $this->engine->on(new $model);

        return $this;
    }

    public function by(Authenticatable $user): Loggingable
    {
        $this->engine->by($user);
        return $this;
    }

    public function with(array $data): Loggingable
    {
        $this->engine->withProperties($data);
        return $this;
    }

    public function titled($title): Loggingable
    {
        $this->engine->inLog($title);
        return $this;
    }

    public function log(string $message): Loggingable
    {
        $this->engine->log($message);
        return $this;
    }
}