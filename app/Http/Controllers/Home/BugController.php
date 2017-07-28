<?php

namespace App\Http\Controllers\Home;

use Auth;
use DB;
use DDL\Models\Bug;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DDL\Repositories\MessageRepository;

class BugController extends Controller
{


    protected  $messageRepository;


    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }


    /**
     * bug 反馈提交表单界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home.bug.index');
    }


    /**
     * 提交bug
     * @param Request $request
     * @return mixed
     */
    public function postBug(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:255'
        ]);

        DB::transaction(function() use($request){
            $user = Auth::user();
            Bug::create([
                'user_id' => $user->id,
                'content' => $request->input('content')
            ]);

            $this->messageRepository->add($user, config('ddl.message.bug'));
        });

        return redirect()->back()->withMessage(['success'=>'提交bug成功, 谢谢。']);
    }




}
