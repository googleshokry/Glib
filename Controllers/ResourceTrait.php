<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 06/05/18
 * Time: 05:50 م
 */

namespace Glib\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Glib\Http\Request\BaseValidation;
use Glib\Logging\ActivityLog;
use Glib\Models\Contracts\Activable;
use Glib\Models\Contracts\HTMLAble;
use Glib\UMS\UMS;


trait ResourceTrait
{

    abstract protected function getRepo(): AbstractRepo;

    abstract protected function getValidator($id = null): BaseValidation;

    public function index()
    {

        $data["rows"] = $this->getRepo()->filter()->paginate(100);

        $row = $this->getRepo()->getModel();

        if (!($row instanceof HTMLAble))
            throw new \Exception("class [" . $row->getClass() . "] must implement [" . HTMLAble::class . "] interface");


        $data["tableInformation"] = $row->getHTMLPresenter()->getTableInformation();

        $data["moreCols"] = $row->getHTMLPresenter()->moreCols();

        return $this->view($data);

    }

    public function create()
    {
        $data['row'] = $this->getRepo()->getModel();
        return $this->view($data);
    }


    public function store()
    {
        $row = $this->getValidator()->validate()->save();
        ActivityLog::make()
            ->titled("create new record")
            ->on($row)
            ->by(UMS::instance()->getUser())
            ->with($this->getRepo()->prepareForSaving())
            ->log("insert new record in table " . $row->getTable());

        flash()->success("تم");
        return $this->redirectTo()->basedOnRequest();
    }

    public function show($id)
    {
        $row = $this->getRepo()->findOrFail($id);

        if (!($row instanceof HTMLAble))
            throw new \Exception("class [" . $row->getClass() . "] must implement [" . HTMLAble::class . "] interface");


        return $this->view(compact("row"));
    }

    public function statuses($id, Request $request)
    {
        $row = $this->getRepo()->findOrFail($id);

        if (!($row instanceof Activable))
            throw new  \Exception("class [" . $this->getRepo()->getModel()->getTable() . "] not instance of" . Activable::class);


        $row->changeStatue((int)$request->status);
        flash()->success("تم");
        return back();
    }

    public function edit($id)
    {
        return $this->view(["row" => $this->getRepo()->findOrFail($id)]);
    }


    public function update($id)
    {
        // dd($id);

        $this->getValidator($id)->validate()->update($id);

        ActivityLog::make()
            ->titled("update record")
            ->on($this->getRepo()->find($id))
            ->by(UMS::instance()->getUser())
            ->with($this->getRepo()->prepareForUpdate())
            ->log("update record id [" . $id . "] in table " . $this->getRepo()->getModel()->getTable());

        flash()->success("تم");
        return $this->redirectTo()->index();
    }

    public function destroy($id)
    {
        if ($this->getRepo()->destroy($id)) {

            ActivityLog::make()
                ->titled("delete record record")
                ->on($this->getRepo()->getModel())
                ->by(UMS::instance()->getUser())
                ->log("delete record id [" . $id . "] in table " . $this->getRepo()->getModel()->getTable());

            flash()->success('تم');
        } else {
            flash()->error('يوجد خطا');
        }
        return $this->redirectTo()->index();
    }

}