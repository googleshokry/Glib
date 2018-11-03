<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 5/14/18
 * Time: 2:26 PM
 */

namespace Glib\Models\Contracts;


interface HTMLAble
{
    public function getHTMLPresenter(): HTMLPresenter;
}