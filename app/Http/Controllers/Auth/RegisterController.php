<?php

namespace App\Http\Controllers\Auth;

use DB;
use DDL\Models\Code;
use DDL\Models\User;
use DDL\Repositories\ImageRepository;
use DDL\Repositories\MessageRepository;
use DDL\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    protected $authService;
    protected $imageRepository;
    protected $messageRepository;

    public function __construct(AuthService $authService, ImageRepository $imageRepository, MessageRepository $messageRepository) {
        $this->authService = $authService;
        $this->imageRepository = $imageRepository;
        $this->messageRepository = $messageRepository;
    }


    /**
     * 注册界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * 注册
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {

        $this->validate($request, [
            'email'    => 'required|email',
//            'password' => 'required|between:6,16',
            'password' => 'required|between:6,16|confirmed',
            'nickname' => 'required|max:20',
            'code'     => 'required|size:4',
        ]);

        // 判断邮箱是否存在
        if (!$this->emailCheck($request->input('email'))){
            return ['status'=>0, 'info'=>'邮箱已存在'];
        }

        // 判断用户名是否存在
        if (!$this->nicknameCheck($request->input('nickname'))){
            return ['status'=>0, 'info'=>'该用户名已存在'];
        }

        // 判断验证码是否正确
        if (!$this->authService->emailCodeCheck($request->input('email'), $request->input('code'))){
            return ['status'=>0, 'info'=>'验证码错误或已失效'];
        }

        $image = $this->imageRepository->avatarDefault();
        DB::transaction(function() use ($request, $image) {
            Code::whereEmail($request->input('email'))->delete();
            //注册
            $user = User::create([
                'nickname' => $request->input('nickname'),
                'email'    => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'image_id' => $image->id
            ]);

            $this->messageRepository->add($user, config('ddl.message.register'));
        });

        return ['status'=>1, 'info'=>'注册成功'];

    }




    /**
     * 表单邮箱检测, 1为通过,0为未通过
     * @param $email
     * @return array
     */
    public function email($email)
    {
        return ['status'=>1, 'info'=>'请求成功', 'check'=>$this->emailCheck($email)?1:0];
    }


    /**
     * 表单昵称检测,同上
     * @param $nickname
     * @return array
     */
    public function nickname($nickname)
    {
        return ['status'=>1, 'info'=>'请求成功', 'check'=>$this->nicknameCheck($nickname)?1:0];
    }


    /**
     * 邮箱检验,true为通过即邮箱不存在,false为未通过即邮箱存在
     * @param $email
     * @return bool
     */
    protected function emailCheck($email)
    {
        return (User::whereEmail($email)->first())?false:true;
    }


    /**
     * 昵称检验,同上
     * @param $nickname
     * @return bool
     */
    protected function nicknameCheck($nickname)
    {
        return (User::whereNickname($nickname)->first())?false:true;
    }





}
