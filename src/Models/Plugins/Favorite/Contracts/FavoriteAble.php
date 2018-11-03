<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 6/10/18
 * Time: 1:22 PM
 */

namespace Glib\Models\Plugins\Contracts\Favorite;


use Glib\UMS\Contracts\Authenticatable;

interface FavoriteAble
{

    public function getItemId(): string;

    public function isFavorite(Authenticatable $user): bool;

    public function changeFavoriteStatus(Authenticatable $user): void;

    public function isFavoriteForCurrentUser(Authenticatable $user = null): bool;

    public function addFavoriteToUser(Authenticatable $user): void;

    public function unFavorite(Authenticatable $user): void;

}