<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 5/9/18
 * Time: 6:21 PM
 */

namespace Glib\Models\Traits;

/**
 * Trait ActivateTrait
 * @package Glib\Models\Traits
 */
trait ActivateTrait
{


    public function getStatus(): int
    {
        return (int)@$this->status;
    }

    public function active(): bool
    {

        return $this->changeStatue(1);
    }

    public function deActivate(): bool
    {
        return $this->changeStatue(0);
    }

    public function changeStatue(int $status): bool
    {



        $this->status = $status;
        $this->save();

        return true;
    }

}