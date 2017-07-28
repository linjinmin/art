<?php

namespace App\Http\Controllers\Admin;

use DDL\Models\Painting;
use DDL\Models\PaintingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaintingController extends Controller
{

    use TableTrait;


    /**
     * 作品进入界面
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {

        // 获取所有画画类型
        $types = PaintingType::select(['id', 'name'])->get();
        $typesArr = array();

        foreach ($types as $type){
            $typesArr[$type->name]  = $type->id;
        }

        $filters = [
            'painting_type_id' => [
                'type'  => 'select',
                'label' => '类型',
                'where' => '=',
                'options' => $typesArr
            ]
        ];


        $trs = [

            '昵称' => function(Painting $painting) {
                return $painting->user->nickname;
            },

            '类型' => function(Painting $painting){
                return $painting->paintingType->name;
            },

            '标题' => function(Painting $painting) {
                return $painting->title;
            },

            '简介' => function(Painting $painting) {
                return substr($painting->introduction, 0, 15);
            },

            '图片' => function(Painting $painting) {
                return "
                    <img src=\"{$painting->image->url}\" alt=\"\" height=\"50px\" width=\"50px\">
                ";
            },

            '操作' => function(Painting $painting) {
                return "
                    <a class='btn btn-xs  btn-primary' href='/admin/painting/show/{$painting->id}'>详情</a>
                    <button class='btn btn-xs  btn-danger' onclick='paintingDelete({$painting->id})'>删除</button>
                ";
            }

        ];

        $objects = $this->getPaginate($request, Painting::whereRaw('1=1'), $filters);

        return view('admin.painting.index')
                ->withTrs($trs)
                ->withObjects($objects)
                ->withFilters($filters);
    }


    /**
     * 详情
     * @param Painting $painting
     * @return mixed
     */
    public function show(Painting $painting)
    {
        return view('admin.painting.show')->withPainting($painting);
    }


    /**
     * 删除
     * @param Painting $painting
     * @return mixed
     */
    public function delete(Painting $painting)
    {
        $painting->delete();
        return redirect()->back()->withMessage(['success'=>'删除成功']);
    }



}
