<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 5/14/18
 * Time: 2:23 PM
 */

namespace Glib\Models\Contracts;


interface HTMLPresenter
{
    public function getTableInformation(): array;

    public function restrictedInfo(): array;

    public function aliases(): array;
    public function moreCols(): array;
}