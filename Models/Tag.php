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

class Tag extends BaseModel implements HTMLAble
{


    protected $table = "tags";

    public static function getName($tag_id)
    {
        if (is_array($tag_id)) {
            return self::findMany($tag_id)->toArray();
        } else {
            return self::find($tag_id);
        }
    }


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
}