<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 11:23 ص
 */

namespace Glib\UMS\Contracts;

use Glib\Upload\MediaFile;

/**
 * Interface Authenticatable
 * @property int $id
 * @package Glib\UMS\Contracts
 */
interface Authenticatable
{
    public function getId(): ?int;

    public function isProfileComplete(): bool;

    public function validateRules(): UserValidateable;

    public function getLoginFields(): array;

    public function isActive(): bool;

    public function getName(): string;

    public function getPassword(): string;

    public function getEmail(): string;

    public function getAvatar(): MediaFile;


}