<?php

namespace App\Http\Controllers\Admin;

use DDL\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{


    use TableTrait;

    public function index(Request $request)
    {

        $trs = [
            'id' => function(Image $image){
                return $image->id;
            },

            '图片' => function(Image $image){
                return "
                    <img src=\"{$image->url}\" alt=\"\" height=\"50px\" width=\"50px\">
                ";
            },

            '操作' => function(Image $image){
                return "
                    <a class='btn btn-xs  btn-primary' href='/admin/image/show/{$image->id}'>详情</a>
                    <button class='btn btn-xs  btn-danger' onclick='imageReset({$image->id})'>重置</>
                    ";
            }
        ];

        $objects = $this->getPaginate($request, Image::whereRaw('1=1'));

        return view('admin.image.index')
                ->withObjects($objects)
                ->withTrs($trs);
    }


    /**
     * 详情
     * @param Image $image
     * @return mixed
     */
    public function show(Image $image)
    {
        return view('admin.image.show')
                ->withImage($image);
    }


    /**
     * 当图片违法重置图片
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Image $image)
    {
        $image->url = config('ddl.reset_url');
        $image->save();
        return \Response::json([
            'status' => 1,
            'info'   => '删除成功'
        ], 200);
    }



}
