<?php

namespace Glib\UMS\AuthTrait;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Glib\UMS\UMS;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 12:49 م
 */
trait AuthTrait
{


    function dashboard()
    {
        return $this->view();
    }

    function getLogin()
    {
        return $this->view();
    }

    public function postLogin()
    {

        $checkUser = UMS::checkUser();
        $vaidator = $checkUser->validateLoginForm();

        if ($vaidator->fails()) {
            flash()->error("من فضلك املا كل الحقول");
            return back()->withErrors($vaidator)->withInput();
        }


        if ($checkUser->makeLogin())
            return UMS::instance()->redirectTo()->dashboard();

        flash()->error("يرجى التأكد من أن حسابك نشط وأدخل معلومات صحيحة ، إذا كانت المشكلة لا تزال على اتصال بالمشرف");
        return back();
    }

    function getForgetPassword()
    {
        return $this->view();
    }

    function postForgetPassword()
    {
        abort(404);
    }


    function getLogout()
    {
        return UMS::instance()->logout()->redirectTo()->login();

    }

    function getChangePassword()
    {
        return $this->view();
//        return UMS::instance()->logout()->redirectTo()->login();

    }

    function postChangePassword()
    {
        $checkUser = UMS::instance()->getUser()->getPassword();
        if (Hash::check(\request()->input('current_password'), $checkUser)) {

            if (\request()->input('confirm_password') == \request()->input('new_password')) {
                UMS::instance()->getUser()->setPassword(\request()->input('confirm_password'));
                flash()->success("Changed Password");
            } else {
                flash()->error("Error in Password");
            }
        }
        else{
            flash()->error("Error in Password");
        }
        return back();

    }


}