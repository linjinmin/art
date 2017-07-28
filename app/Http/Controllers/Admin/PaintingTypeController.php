<?php

namespace App\Http\Controllers\Admin;

use DDL\Models\PaintingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaintingTypeController extends Controller
{

    use TableTrait;


    /**
     * 画画类型界面
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $trs = [
            'id' => function(PaintingType $type) {
                return $type->id;
            },

            '类型' => function(PaintingType $type) {
                return $type->name;
            },

            '操作' => function(PaintingType $type) {
                return "
                    <a class='btn btn-xs btn-primary ' href='/admin/painting/type/edit/{$type->id}'>编辑</a>
                    <a class='btn btn-xs btn-danger ' href='/admin/painting/type/delete/{$type->id}'>删除</a>
                ";
            },

        ];

        $objects = $this->getPaginate($request, PaintingType::whereRaw('1=1'));

        return view('admin.paintingtype.index')
                ->withTrs($trs)
                ->withObjects($objects);
    }


    /**
     * 添加界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('admin.paintingtype.add');
    }


    /**
     * 添加
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required:max:20'
        ]);

        PaintingType::create($request->all());

        return redirect()->to('/admin/painting/type/index')->withMessage(['success'=>'添加成功']);
    }


    /**
     * 删除
     * @param PaintingType $type
     * @return $this
     */
    public function delete(PaintingType $type)
    {
        if ($type->id == 1){
            return redirect()->back()->withErrors('无效的操作');
        }

        $type->delete();

        return redirect()->back()->withMessage(['success'=>'删除成功']);
    }


    /**
     * 编辑
     * @param PaintingType $type
     * @return mixed
     */
    public function edit(PaintingType $type)
    {
        return view('admin.paintingtype.edit')->withType($type);
    }


    /**
     * 保存
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id'   => 'required',
            'name' => 'required|max:20'
        ]);

        PaintingType::where('id', '=', $request->input('id'))->update(['name' => $request->input('name')]);

        return redirect()->to('/admin/painting/type/index')->withMessage(['success'=>'保存成功']);
    }


}
