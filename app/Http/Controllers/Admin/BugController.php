<?php

namespace App\Http\Controllers\Admin;


use DDL\Models\Bug;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BugController extends Controller
{


    use TableTrait;


    /**
     * bug 界面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $trs = [

            '邮箱' => function(Bug $bug){
                return $bug->user->email;
            },

            '昵称' => function(Bug $bug) {
                return $bug->user->nickname;
            },

            'bug' => function(Bug $bug) {
                return substr($bug->content, 0, 15);
            },

            '操作' => function(Bug $bug) {
                return "
                        <a class='btn btn-xs btn-primary ' href='/admin/bug/show/{$bug->id}'>详情</a>
                ";
            },

        ];

        $objects = $this->getPaginate($request, Bug::whereRaw('1=1'));
        return view('admin.bug.index')
                ->withObjects($objects)
                ->withTrs($trs);
    }


    /**
     * bug 详情界面
     * @param Bug $bug
     * @return mixed
     */
    public function show(Bug $bug)
    {
        return view('admin.bug.show')->withBug($bug);
    }


}
