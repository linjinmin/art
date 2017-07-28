<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DDL\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{


    /**
     * 获取后台登录界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('admin.auth.login');
    }


    /**
     * 登录
     * @param Request $request
     * @return $this
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|between:6,16'
        ]);


        if(!Auth::attempt(['email' => $request->input('email'), 'password'=>$request->input('password'), 'role'=>User::ROLE_MANAGER])){
            return redirect()->back()->withErrors('账号或密码错误');
        }


        return redirect()->to('/admin/index')->withMessage(['info'=>'登录成功']);

    }









}
