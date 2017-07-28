<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 24/04/2017
 * Time: 22:08
 */

namespace DDL\Services;

use Mail;
use DDL\Models\User;
use DDL\Models\Code;
use DDL\Repositories\UserRepository;
use Naux\Mail\SendCloudTemplate;

class AuthService extends BaseService
{
    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * 发送邮件事件检测,  1分钟内无法再次发送
     * @param $email
     * @return int
     */
    public function sendEmailTimeCheck($email)
    {
        $code = Code::whereEmail($email)->first();
        if (!$code){
            return true;
        } else {
            if (strtotime($code->updated_at)+60 > time()){
                return false;
            } else {
                return true;
            }
        }
    }


    /**
     * 发送邮件
     * @param $email
     * @param $code
     */
    public function sendEmail($email, $code)
    {
        $codeObj = Code::whereEmail($email)->first();
        if ($codeObj){
            $codeObj->code = $code;
            $codeObj->save();
        } else {
            Code::create([
                'email' => $email,
                'code'  => $code,
            ]);
        }

        // 发送邮件
        Mail::send('email.empty', [], function ($message) use ($email, $code) {
            $message->from(config('ddl.email'), '园丁鸟');
            $message->to($email)->cc('bar@example.com');
            // 模板变量
            $bind_data = ['code' => $code];
            $template = new SendCloudTemplate(config('ddl.email_template'), $bind_data);
            $message->getSwiftMessage()->setBody($template);
        });

    }


    /**
     * 邮箱验证码检测
     * @param $email
     * @param $code
     * @return bool
     */
    public function emailCodeCheck($email, $code)
    {
        return Code::whereEmail($email)->whereCode($code)->where('updated_at', '>', date('Y-m-d H:i:s', time()-300))->first()?true:false;
    }






}