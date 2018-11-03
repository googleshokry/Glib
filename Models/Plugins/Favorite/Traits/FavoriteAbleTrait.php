<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 6/10/18
 * Time: 1:22 PM
 */

namespace Glib\Models\Plugins\Traits\Favorite;


use Glib\Models\BaseModel;
use Glib\Models\Plugins\Favorite\Favorite;
use Glib\UMS\Contracts\Authenticatable;

/**
 * Trait FavoriteAbleTrait
 * @package Glib\Models\Plugins\Favorite
 */
trait FavoriteAbleTrait
{
    public function changeFavoriteStatus(Authenticatable $user): void
    {
        if ($this->isFavorite($user))
            $this->unFavorite($user);
        else
            $this->addFavoriteToUser($user);
    }

    public function isFavoriteForCurrentUser(Authenticatable $user = null): bool
    {
        if (is_null($user)) {

            if (!customerAuther()->isLogin())
                return false;

            $user = customerAuther()->getUser();
        }

        return $this->isFavorite($user);

    }

    public function isFavorite(Authenticatable $user): bool
    {

        /** @var BaseModel $this */
        return (Favorite::getForUserAndModel($user, $this)) ? true : false;
    }

    public function addFavoriteToUser(Authenticatable $user): void
    {
        /** @var BaseModel $this */
        Favorite::add($user, $this);
    }

    public function unFavorite(Authenticatable $user): void
    {
        /** @var BaseModel $this */
        Favorite::remove($user, $this);
    }
}