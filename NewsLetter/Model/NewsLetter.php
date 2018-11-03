<?php

namespace Glib\NewsLetter\Model;

use Glib\Models\BaseModel;

/**
 * Class NewsLetter
 * @method static $this whereEmail($email)
 * @property string email
 * @package Glib\NewsLetter
 * @property int status
 */
class NewsLetter extends BaseModel
{
    const active = 1;
    const pending = 2;
    const deactivate = 0;
    protected $table = "newsletter";

    public static function createOrUpdate($email, $list = "default", $status = false)
    {
        return self::upsart(["email" => $email], ["list" => $list, "status" => ($status) ? self::pending : self::active]);
    }

    public function updateEmail($newEmail)
    {
        $this->email = $newEmail;
        return $this->save();
    }

    public function deactivate()
    {
        $this->status = self::deactivate;

        return $this->save();
    }

}