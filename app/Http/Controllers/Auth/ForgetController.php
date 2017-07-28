<?php

namespace App\Http\Controllers\Auth;

use DB;
use DDL\Models\User;
use DDL\Models\Code;
use Illuminate\Support\Facades\Auth;
use DDL\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgetController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }


    /**
     * 获取重置界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReset()
    {
        return view('auth.forget');
    }


    /**
     * 重置密码
     * @param Request $request
     * @return array
     */
    public function reset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|between:6,16|confirmed',
            'code'  => 'required|size:4'
        ]);

        // 判断验证码是否正确
        if (!$this->authService->emailCodeCheck($request->input('email'), $request->input('code'))){
            return ['status'=>0, 'info'=>'验证码错误或已失效'];
        }

        DB::transaction(function() use ($request){
            $user = User::whereEmail($request->input('email'))->first();
            $user->password = bcrypt($request->input('password'));
            $user->save();
            Code::whereEmail($request->input('email'))->delete();
        });

        return ['status'=>1, 'info'=>'重置密码成功'];
    }



}
