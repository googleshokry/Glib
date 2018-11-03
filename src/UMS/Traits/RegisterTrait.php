<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 15/04/18
 * Time: 05:35 م
 */

namespace Glib\UMS\AuthTrait;


use Illuminate\Http\Request;
use Glib\Mailer\Contracts\MailMEInterFace;
use Glib\NewsLetter\NewsLetter;
use Glib\UMS\Contracts\Authenticatable;
use Glib\UMS\Contracts\RegistrableInterface;
use Glib\UMS\UMS;


/**
 * Trait RegisterTrait
 * @package Glib\UMS\AuthTrait
 * @method view()
 */
trait RegisterTrait
{
    function getRegister()
    {
        return $this->view();
    }

    function postRegister()
    {


        $checkUser = UMS::checkUser();
        $vaidator = $checkUser->validateRegisterForm();

        if ($vaidator->fails()) {
            flash()->error("من فضلك املا كل الحقول");
            return back()->withErrors($vaidator)->withInput();
        }


        $resultOfRegistration = $checkUser->register(
            \request()->only("email", "password"),
            function (Authenticatable $user) {
                NewsLetter::make($user->getEmail())->subscribePending();
            }
        );


        if ($resultOfRegistration) {
            flash()->success("تهانينا تم إنشاء حسابك بنجاح ، يرجى التحقق من بريدك الإلكتروني بحثًا عن رابط التنشيط ");
            return UMS::instance()->redirectTo()->login();
        }

        flash()->error("يرجى التأكد من إدخال المعلومات الصحيحة");
        return back();
    }

    public function activeUser(Request $request)
    {
        $token = $request->_t;
        if (!$token)
            return $this->view(["message" => "sorry your account cant be activated, please contact with administration"], "error");


        $user = UMS::checkUser()->activeUser($token);

        if ($user)
            flash()->success("your account active successfully");
        else
            flash()->error("some thing wrong has occur ");

        return redirect(UMS::instance()->getScopeConfig()->loginUrl());
    }
}