<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 29/03/18
 * Time: 09:07 م
 */

namespace Glib\Mailer\Models;

use Glib\Models\BaseModel;
use App\Services\EmailLogging;


/**
 * @property mixed subject
 * @property mixed user_email
 * @property mixed user_name
 * @property mixed data
 * @property mixed status
 * @property mixed template
 */
class EmailLog extends BaseModel
{
    /**
     *
     */
    const fails = 0;
    /**
     *
     */
    const sent = 1;
    /**
     * @var string
     */
    protected $table = "emails";
    /**
     * @var array
     */
    private static $statuses = ["0" => "fail", "1" => "sent"];


    /**
     * @param $status
     * @param $template
     * @param $subject
     * @param $data
     * @param $userEmail
     * @param $userName
     * @return static
     */
    public static function createLog($status, $template, $subject, $data, $userEmail, $userName)
    {
        return self::quickSave([
            "data" => $data,
            "status" => $status,
            "subject" => $subject,
            "template" => $template,
            "user_name" => $userName,
            "user_email" => $userEmail,
        ]);
    }


    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @return mixed
     */
    public function getSendData()
    {
        return json_decode($this->data);
    }

    /**
     * @return mixed
     */
    public function getStatusName()
    {
        return self::$statuses[$this->status];
    }

    /**
     *
     */
    public function reSend()
    {
        $status = (new EmailLogging($this->template, $this->subject, $this->getSendData(), $this->getUserEmail(), $this->getUserName()))->send()->getStatus();

        if ($status) {
            $this->status = $status;
            $this->save();
        }
    }

}