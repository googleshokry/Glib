<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 29/03/18
 * Time: 08:46 م
 */

namespace Glib\Mailer;


use Glib\Mailer\Models\EmailLog;


class EmailLogging
{
    public static function sendWithLog($template, $subject, $data, $userEmail, $userName = "Guest")
    {
        return (new static($template, $subject, $data, $userEmail, $userName))->send()->log();
    }

    private $template;
    private $subject;
    /**
     * @var array|object
     */
    private $data;
    private $userEmail;

    /**
     * @var string
     */
    private $userName;
    /**
     * @var bool
     */
    private $status;

    public function __construct($template = "main", $subject = "subject", $data = [], $userEmail = "email@mail.com", $userName = "Guest")
    {
        $this->template = $template;
        $this->subject = $subject;
        $this->data = $data;
        $this->userEmail = $userEmail;
        $this->userName = $userName;
    }

    /**
     * @return EmailLog
     */
    public function log()
    {
        return EmailLog::createLog($this->getStatus(), $this->getTemplate(), $this->getSubject(), json_encode($this->getData()), $this->getUserEmail(), $this->getUserName());
    }

    public function send()
    {
        try {
            $data = (array)$this->getData();
            $data["subject"] = $this->getSubject();

            \Mail::send($this->getTemplate(), $data, function ($mail) {
                $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                $mail->to($this->getUserEmail(), $this->getUserName())->subject($this->getSubject());
            });
            $this->setStatus(EmailLog::sent);
        } catch (\Exception $exception) {
            $this->setStatus(EmailLog::fails);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param $userEmail
     * @return $this
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
        return $this;

    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return $this
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;

    }

}