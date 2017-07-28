<?php

namespace App\Http\Controllers;

use DDL\Services\AuthService;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    /**
     * 发送邮件
     * @param Request $request
     * @return array
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        // 判断距离上次请求是否大于1分钟
        if (!$this->authService->sendEmailTimeCheck($request->input('email'))){
            return ['status'=>0, 'info'=>'一分钟后才能再次发送邮件'];
        }

        $code = $this->randomCode();
        $this->authService->sendEmail($request->input('email'), $code);
        return ['status'=>1, 'info'=>'验证码已放送至邮箱。'];
    }


    /**
     * 生成随机验证码
     * @return string
     */
    protected function randomCode()
    {
        $code = "";
        $str  = "1234567890";
        for ($i=0; $i<4; $i++){
            $code .= $str[mt_rand(0, strlen($str) -1)];
        }
        return $code;
    }


}
