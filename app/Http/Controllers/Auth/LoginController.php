<?php

namespace App\Http\Controllers\Auth;

use DDL\Models\User;
use Illuminate\Support\Facades\Auth;
use DDL\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    protected $authService;


    public function __construct(AuthService $authService) {
        $this->authService = $authService;
        $this->middleware('guest');
    }


    /**
     * 登录界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login');
    }


    /**
     * 登录
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {

        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required|between:6,16',
        ]);

        $remember = $request->input('remember_token')=="true"?true:false;
        if (!Auth::attempt(['email' => $request->input('email'), 'password'=>$request->input('password')], $remember)){
            // 邮箱或秘密错误
            return ['status'=>0, 'info'=>'邮箱或密码错误'];
        }

        $user = Auth::user();

        if ($user->status == User::STATUS_FAILED){
            Auth::logout();
            return ['status'=>0, 'info'=>'当前账号已被禁用,请联系管理员'];
        }

        return ['status'=>1, 'info'=>'登录成功'];
    }









}
