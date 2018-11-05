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
            flash()->error(__t('please fill all fields'));
            return back()->withErrors($vaidator)->withInput();
        }


        $resultOfRegistration = $checkUser->register(
            \request()->only("email", "password"),
            function (Authenticatable $user) {
                NewsLetter::make($user->getEmail())->subscribePending();
            }
        );


        if ($resultOfRegistration) {
            flash()->success(__t('Congratulations Your account was successfully created, please check your email for the activation link'));
            return UMS::instance()->redirectTo()->login();
        }

        flash()->error(__t('Please make sure you enter correct information'));
        return back();
    }

    public function activeUser(Request $request)
    {
        $token = $request->_t;
        if (!$token)
            return $this->view(["message" => __t("sorry your account cant be activated, please contact with administration")], "error");


        $user = UMS::checkUser()->activeUser($token);

        if ($user)
            flash()->success(__t("your account active successfully"));
        else
            flash()->error(__t("some thing wrong has occur"));

        return redirect(UMS::instance()->getScopeConfig()->loginUrl());
    }
}