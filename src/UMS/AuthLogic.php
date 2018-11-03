<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 01:34 م
 */

namespace Glib\UMS;


use Illuminate\Contracts\Validation\Validator as V;
use Glib\Mailer\Contracts\MailMEInterFace;
use Glib\Models\BaseModel as Model;
use Illuminate\Http\Request;

//use Validator;

//use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Factory;
use Glib\UMS\Contracts\Authenticatable;
use Glib\UMS\Contracts\RegistrableInterface;

class AuthLogic
{
    /**
     * @var Authenticatable|RegistrableInterface
     */
    private $userModel;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var UMS
     */
    private $UMS;

    public function __construct(UMS $UMS, Request $request = null)
    {
        $this->UMS = $UMS;
        $this->userModel = $UMS->getScopeConfig()->userModel();
        $this->request = $request ?? request();
    }

    private function validateRequest($rules): V
    {
        return \Validator::make($this->request->all(), $rules);
    }

    /**
     * @return V
     */
    public function validateLoginForm()
    {
        $validate = $this->validateRequest([
            'login_field' => 'required|email',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        if ($validate->fails())
            $this->UMS->getLogging()->by($this->userModel)->log("guest user tried to login and fail");

        return $validate;
    }


    /**
     * @return V
     */
    public function validateRegisterForm()
    {
        $validate = $this->validateRequest($this->userModel->validateRules()->register());

        if ($validate->fails())
            $this->UMS->getLogging()->by($this->userModel)->log("guest user tried to register and fail");

        return $validate;
    }


    /**
     * @return V
     */
    public function validateForgetPassword()
    {

        $validate = $this->validateRequest($this->userModel->validateRules()->register());

        if ($validate->fails())
            $this->UMS->getLogging()->by($this->userModel)->log("guest user tried to reset his password and fail");

        return $validate;
    }


    public function makeLogin(\Closure $callback = null)
    {
        $loginField = $this->getLoginField();
        $requestLoginField = $this->request->{$loginField};
        $status = true;
        /** @var Model $um */
        $um = $this->userModel;
        foreach ($this->userModel->getLoginFields() as $field)
            $um = $um->where($field, $requestLoginField);

        /** @var Authenticatable $user */
        $user = $um->first();

        if (!$user) {
            $this->UMS->getLogging()->with([$loginField, $requestLoginField])->log("user not found in system");
            return false;
        }

        if (!$user->isActive()) {
            $this->UMS->getLogging()->by($user)->with([$loginField, $requestLoginField])->log("user not Active ");
            return false;
        }

        if (!\Hash::check($this->request->password, $user->getPassword())) {
            $this->UMS->getLogging()->by($user)->with([$loginField, $requestLoginField])->log("user entered wrong password ");
            return false;
        }

        if (is_callable($callback))
            $status = $callback($user);

        if ($status)
            $this->UMS->setUser($user);

        $this->UMS->getLogging()->by($user)->with([$loginField, $requestLoginField])->log("user login successfully");
        return true;
    }

    public function register(array $dataSource = null, \Closure $callback = null)
    {


        return $this->userModel->registerNewUser($dataSource, function (Authenticatable $user) use ($callback) {


            /*
           *
           */
            if (!($user instanceof MailMEInterFace))
                throw new \Exception("user object must be [" . MailMEInterFace::class . "]");

            if (!($user instanceof RegistrableInterface))
                throw new \Exception("user object must be [" . RegistrableInterface::class . "]");



            /**
             *
             */
            $user->mailMe()
                ->setSubject("welcome to " . env("APP_NAME"))
                ->setAttributes(["user" => $user, "activeUrl" => UMS::instance()->getScopeConfig()->getActiveUrl($user->getActiveToken())])
                ->setTemplate("customer.email.activeAccount")
                ->send();

            /**
             *
             */
            $this->UMS->getLogging()->by($user)->with(["email", $user->getEmail()])->log("new user Created");
            /**
             *
             */
            if (is_callable($callback))
                $callback($user);

        });
    }

    /**
     * @return string
     */
    public function getLoginField(): string
    {
        return "login_field";
    }

    public function activeUser($token, \Closure $cb = null)
    {
        if (!($this->userModel instanceof RegistrableInterface))
            throw new \Exception($this->userModel->getTable() . "must be instance of " . RegistrableInterface::class);

        $user = $this->userModel->activeMe($token);

        if ($user instanceof Authenticatable)
            $this->UMS->getLogging()->by($user)->with(["email", $user->getEmail()])->log("new user Created");

        return $user;


    }
}