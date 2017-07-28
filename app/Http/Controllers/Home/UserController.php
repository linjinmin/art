<?php

namespace App\Http\Controllers\Home;

use Auth;
use DB;
use DDL\Models\Painting;
use DDL\Models\User;
use DDL\Repositories\ImageRepository;
use DDL\Models\PainerApply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DDL\Repositories\UserRepository;
use DDL\Repositories\MessageRepository;

class UserController extends Controller
{


    protected $userRepository;
    protected $imageRepository;
    protected $messageRepository;


    public function __construct(UserRepository $userRepository, ImageRepository $imageRepository, MessageRepository $messageRepository)
    {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
        $this->messageRepository = $messageRepository;
    }


    /**
     * 用户个人中心
     */
    public function userInformation($nickname)
    {
        $userInfo = User::where('nickname', '=', $nickname)->first();
        if (empty($userInfo)){
            return redirect()->back()->withErrors('不存在的用户');
        }

        $works = Painting::where('user_id', '=',$userInfo->id)->get();

        return view('home.user.info')->with('userInfo', $userInfo)->withWorks($works);
    }

    /**
     * 修改信息界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit()
    {
        return view('home.user.edit');
    }


    /**
     * 用户信息修改
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        $this->validate($request, [
            'signature' => 'max:30',
            'sex'       => 'required|in:男,女,保密',
        ]);

        $user = Auth::user();
        $user->signature = $request->input('signature');
        $user->sex       = $request->input('sex');
        $user->save();
        return redirect()->to('/home/user/info/' . $user->nickname);
    }


    /**
     * 画家之路进入界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getApply()
    {
        $user = Auth::user();
        $painer = $this->userRepository->painerApplyGetByStatus($user, PainerApply::STATUS_WAIT)->first();
        return view('home.user.painer')->withPainer($painer);
    }


    /**
     * 申请成为画家
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function apply(Request $request)
    {
        $this->validate($request, [
            'url' => 'required',
            'describe' => 'required|max:50'
        ]);

        $user = Auth::user();

        if ($user->role != User::ROLE_MEMBER){
            return redirect()->back()->withErrors("无效的请求");
        }

        $image = $this->imageRepository->imageUrlGet($request->input('url'));
        if (empty($image)){
            return redirect()->back()->withErrors('服务器发生错误');
        }

        // 判断一下是否已申请过
        if (PainerApply::whereStatus(PainerApply::STATUS_WAIT)->where('user_id', '=', $user->id)->first()){
            return redirect('/home/user/painer')->withErrors("您已申请,请耐心等待审核。");
        }


        DB::transaction(function() use($image, $request, $user) {
            $user->painterApply()->create([
                'image_id' => $image->id,
                'describe' => $request->input('describe')
            ]);

            $this->messageRepository->add($user, config('ddl.message.painer_apply'));
        });

        return redirect('/home/user/painer')->withMessage(['success'=>'成功提交申请']);
    }







}
