<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 05:23 م
 */

namespace Glib\Models;


use Glib\Models\Contracts\HTMLAble;
use Glib\Models\Contracts\HTMLPresenter;

class Review extends BaseModel implements HTMLAble
{
    protected $table = "reviews";
    const status = ['desactive'=>0,'active'=>1];

    public function getHTMLPresenter(): HTMLPresenter
    {
        return new class() implements HTMLPresenter
        {
            public function getTableInformation(): array
            {
                return [
                    "name" => tableColumn()->filter(),
                ];
            }

            public function restrictedInfo(): array
            {
                return [];
            }

            public function aliases(): array
            {
                return [];
            }

            public function moreCols(): array
            {
                return [];
            }
        };
    }

    /**
     * @return mixed
     */
    public function userModel()
    {
        return $this->user::find($this->user_id);
    }
}