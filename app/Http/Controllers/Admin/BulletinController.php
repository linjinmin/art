<?php

namespace App\Http\Controllers\Admin;

use DDL\Models\Bulletin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BulletinController extends Controller
{
    use TableTrait;


    /**
     * 公告进入界面
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {

        $trs = [
            '标题' => function(Bulletin $bulletin) {
                return $bulletin->title;
            },

            '详情' => function(Bulletin $bulletin) {
                return substr($bulletin->content, 0, 15);
            },

            '操作' => function(Bulletin $bulletin) {
                return "
                    <a class='btn btn-xs btn-primary ' href='/admin/bulletin/show/{$bulletin->id}'>详情</a>
                ";
            }
        ];

        $objects = $this->getPaginate($request, Bulletin::whereRaw('1=1')->orderBy('id', 'desc'));
        return view('admin.bulletin.index')
                ->withObjects($objects)
                ->withTrs($trs);
    }


    /**
     * 作品展示界面
     * @param Bulletin $bulletin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Bulletin $bulletin)
    {
        return view('admin.bulletin.show')->withBulletin($bulletin);
    }


    /**
     * 发表公告界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('admin.bulletin.add');
    }


    /**
     * 添加公告
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:20',
            'content' => 'required|max:255'
        ]);

        Bulletin::create($request->all());

        return redirect()->to('/admin/bulletin/index')->withMessage(['success'=>'发表公告成功']);
    }


}
