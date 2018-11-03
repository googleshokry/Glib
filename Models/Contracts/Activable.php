<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 5/9/18
 * Time: 6:05 PM
 */

namespace Glib\Models\Contracts;


interface Activable
{
    public function getStatus(): int;

    public function active(): bool;

    public function deActivate(): bool;

    public function changeStatue(int $status): bool;
}