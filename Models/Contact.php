<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 05:23 م
 */

namespace Glib\Models;


use App\Models\HTMLPresentations\ContactsPresenter;
use Glib\Contact\Traits\ContactTrait;
use Glib\Models\Contracts\HTMLAble;
use Glib\Models\Contracts\HTMLPresenter;
use Glib\Support\StringToArray;
use Glib\Support\Text;

class Contact extends BaseModel implements HTMLAble
{
    use ContactTrait;

    protected $table = "contact";

    public function getHTMLPresenter(): HTMLPresenter
    {
        return new class ($this)implements HTMLPresenter
        {

            /**
             * @var Contact
             */
            private $model;

            public function __construct(Contact $model)
            {
                $this->model = $model;
            }

            public function getTableInformation(): array
            {

                return [
                    "created_at" => tableColumn()->setAlisa('Sended'),
                ];

            }

            public function restrictedInfo(): array
            {
                return [];
            }

            public function aliases(): array
            {

                return [
                    "content" => $this->model->getContent(),
                    "type" => $this->model->getType(),
                ];
            }
            public function moreCols(): array
            {
                return [];
            }
        };

    }

}