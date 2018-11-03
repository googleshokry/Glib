<?php

namespace Glib\UMS;


use Glib\Logging\Contracts\Loggingable;
use Glib\UMS\Contracts\Authenticatable;
use Glib\UMS\Contracts\ScopeConfig;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 11/04/18
 * Time: 11:20 ص
 */
class UMS
{

    /**
     * @var Loggingable
     */
    private $logging;
    /**
     * @var
     */
    private static $_currentScope;
    /**
     * @var
     */
    private static $_instances;
    /**
     * @var ScopeConfig
     */
    private $scopeConfig;
    /**
     * @var string
     */
    private $sessionKey;

    /**
     * @param ScopeConfig|null $scopeConfig
     * @return UMS
     */
    public static function instance(ScopeConfig $scopeConfig = null): self
    {

        if (is_null($scopeConfig))
            return self::getCurrentInstance();


        self::$_currentScope = $scopeConfig->scopeName();

        if (!isset(self::$_instances[self::$_currentScope]))
            self::$_instances[self::$_currentScope] = new static($scopeConfig);


        return self::$_instances[self::$_currentScope];
    }

    /**
     * @return UMS
     * @throws \Exception
     */
    private static function getCurrentInstance(): self
    {
        if (!self::$_currentScope)
            throw new \Exception("No scope detected for UMS");


        if (!isset(self::$_instances[self::$_currentScope]))
            throw new \Exception("No scope detected for UMS");

        return self::$_instances[self::$_currentScope];

    }


    /**
     * UMS constructor.
     * @param ScopeConfig $scopeConfig
     */
    public function __construct(ScopeConfig $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        $this->sessionKey = env("APP_KEY") . "::" . $this->getScopeConfig()->scopeName();
    }

    /**
     * @return AuthLogic
     */
    public static function checkUser()
    {
        return new AuthLogic(self::instance());
    }

    /**
     * @return bool
     */
    public function isLogin(): bool
    {
        return (session()->exists($this->sessionKey) && !is_null(session()->get($this->sessionKey)));
    }

    /**
     * @return ScopeConfig
     */
    public function getScopeConfig(): ScopeConfig
    {
        return $this->scopeConfig;
    }

    /**
     * @param Authenticatable $authenticatableUser
     * @return UMS
     */
    public function setUser(Authenticatable $authenticatableUser): self
    {
        session()->put($this->sessionKey, $authenticatableUser);
        return $this;
    }

    /**
     * @return Authenticatable
     */
    public function getUser(): ?Authenticatable
    {
        return session()->get($this->sessionKey);
    }

    /**
     * @return $this
     */
    public function logout()
    {
        session()->remove($this->sessionKey);
        return $this;
    }

    /**
     * @return RedirectTo
     */
    public function redirectTo()
    {
        return new RedirectTo($this);
    }

    /**
     * @return Loggingable
     */
    public function getLogging(): Loggingable
    {
        return $this->logging;
    }

    /**
     * @param Loggingable $logging
     * @return $this
     */
    public function setLogging(Loggingable $logging)
    {
        $this->logging = $logging;
        return $this;
    }
}