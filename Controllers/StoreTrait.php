<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 06/05/18
 * Time: 05:50 م
 */

namespace Glib\Controllers;


use Illuminate\Http\Request;

use Glib\Http\Request\BaseValidation;
use Glib\Logging\ActivityLog;
use Glib\Models\Contracts\Activable;
use Glib\Models\Contracts\HTMLAble;
use Glib\UMS\UMS;


trait StoreTrait
{

    abstract protected function getRepo(): AbstractRepo;

    abstract protected function getValidator($id=null): BaseValidation;

    public function index()
    {
        $data["row"] = ($this->getRepo()->getModel())->first();

        $row = $this->getRepo()->getModel();

        if (!($row instanceof HTMLAble))
            throw new \Exception("class [" . $row->getClass() . "] must implement [" . HTMLAble::class . "] interface");


        return $this->view($data);

    }

    public function edit($id)
    {
        return $this->view(["row" => $this->getRepo()->findOrFail($id)]);
    }


    public function update()
    {
        @$rid = ($this->getRepo()->getModel())->first()->getId();
        if (is_null($rid))
        {
            $rid  = (($this->getRepo()->getModel())->save())->first()->getId();

        }
        $this->getValidator($rid)->validate()->update($rid);

        ActivityLog::make()
            ->titled("update record")
            ->on($this->getRepo()->find($rid))
            ->by(UMS::instance()->getUser())
            ->with($this->getRepo()->prepareForUpdate())
            ->log("update record id [" . $rid . "] in table " . $this->getRepo()->getModel()->getTable());

        flash()->success(self::$_module . " updated successfully");
        return $this->redirectTo()->index();
    }


}