<?php
/**
 * Created by PhpStorm.
 * User: shokry
 * Date: 28/06/18
 * Time: 12:08 م
 */


Route::delete("media/delete/{id}", function ($id) {
    \Glib\Models\Media::quickDelete($id);


    if (request()->ajax())
        return response()->json(["status" => true]);


    return back();
})->name("media.delete");



