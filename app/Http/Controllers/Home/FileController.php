<?php

namespace App\Http\Controllers\Home;

use Auth;
use File;
use Response;
use Validator;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;
use DDL\Models\Image as DImage;
use Illuminate\Http\Request;
use DDL\Services\FileService;
use App\Http\Controllers\Controller;

class FileController extends Controller
{

    protected $fileService;


    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    /**
     * 画家之路申请图片上传
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function applyUpload(Request $request)
    {

        $this->validate($request, [
            'file' => 'required',
        ]);

        $file = $request->file('file');

        // 判断格式
        if (!$this->fileService->isImage($file->getMimeType())){
            return ['status'=>0, 'info'=>'图片格式不合法'];
        }

        // 判断大小
        if (!$this->fileService->legalSize($file->getSize(), 3145728)){
            return ['status'=>0, 'info'=>'图片大小应小于3M'];
        }

        $path = DImage::PAINER_APPLY_PATH;
        $original_name = $file->getClientOriginalName();
        $original_name_without_ext = substr($original_name, 0, strlen($original_name) - 4);
        $filename = $this->sanitize($original_name_without_ext);
        $allowed_filename = $this->createUniqueFilename($filename, DImage::PAINER_APPLY_PATH);
        $filename_ext = $allowed_filename .'.jpg';
        $file->move($path, $filename_ext);

        DImage::create([
            'url' => '/'.$path.$filename_ext
        ]);

        return ['status' => 1, 'info'=>'上传图片成功', 'url'=>'/'.$path.$filename_ext];
    }


    /**
     * 头像上传
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function avatarUpload()
    {

        $form_data = Input::all();

        $validator = Validator::make($form_data, DImage::$rules, DImage::$messages);

        if ($validator->fails()) {

            return Response::json([
                'status' => 'error',
                'message' => $validator->messages()->first(),
            ], 200);

        }

        $img = $form_data['img'];


        // 判断格式
        if (!$this->fileService->isImage($img->getMimeType())){
            return ['status'=>'error', 'message'=>'图片格式不合法'];
        }

        // 判断大小
        if (!$this->fileService->legalSize($img->getSize(), DImage::FILE_MAX)){
            return ['status'=>'error', 'message'=>'图片大小应小于3M'];
        }

        $original_name = $img->getClientOriginalName();
        $original_name_without_ext = substr($original_name, 0, strlen($original_name) - 4);
        $filename = $this->sanitize($original_name_without_ext);
        $allowed_filename = $this->createUniqueFilename($filename, DImage::AVATAR_PATH);
        $filename_ext = $allowed_filename .'.jpg';
        $manager = new ImageManager();
        $image = $manager->make( $img )->encode('jpg')->save(DImage::AVATAR_PATH . $filename_ext );

        $dImage = DImage::create([
            'url' => '/' . DImage::AVATAR_PATH . $filename_ext
        ]);

        $user = Auth::user();
        $user->image_id = $dImage->id;
        $user->save();

        if (!$image){
            return Response::json([
                'status' => 'error',
                'message'   => 'Server error while uploading',
            ], 200);
        }

        return Response::json([
            'status' => 'success',
            'url'   =>  '/' . DImage::AVATAR_PATH . $filename_ext,
            'width'  => $image->width(),
            'height' => $image->height(),
        ], 200);

    }


    /**
     * 发表作品图片上传
     * @param Request $request
     * @return array
     */
    public function releaseUpload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);

        $file = $request->file('file');

        // 判断格式
        if (!$this->fileService->isImage($file->getMimeType())){
            return ['status'=>0, 'info'=>'图片格式不合法'];
        }

        // 判断大小
        if (!$this->fileService->legalSize($file->getSize(), 3145728)){
            return ['status'=>0, 'info'=>'图片大小应小于3M'];
        }

        $path = DImage::PAINTING_PATH;
        $original_name = $file->getClientOriginalName();
        $original_name_without_ext = substr($original_name, 0, strlen($original_name) - 4);
        $filename = $this->sanitize($original_name_without_ext);
        $allowed_filename = $this->createUniqueFilename($filename, DImage::PAINTING_PATH);
        $filename_ext = $allowed_filename .'.jpg';
        $file->move($path, $filename_ext);
        DImage::create([
            'url' => '/' . $path . $filename_ext
        ]);
//        $this->fileService->cropByProportion($path.$filename_ext, DImage::PAINTING_PROPORTION, DImage::PAINTING_PROPORTION);

        return ['status' => 1, 'info'=>'上传图片成功', 'url'=>'/' . $path . $filename_ext];
    }


    /**
     * 剪辑,并覆盖原来的路径
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCropCover()
    {
        $form_data = Input::all();
        $image_url = $form_data['imgUrl'];


        // resized sizes
        $imgW = $form_data['imgW'];
        $imgH = $form_data['imgH'];
        // offsets
        $imgY1 = $form_data['imgY1'];
        $imgX1 = $form_data['imgX1'];
        // crop box
        $cropW = $form_data['width'];
        $cropH = $form_data['height'];
        // rotation angle
        $angle = $form_data['rotation'];

        $manager = new ImageManager();
        $image = $manager->make( substr($image_url, 1) );
        $image->resize($imgW, $imgH)
            ->rotate(-$angle)
            ->crop($cropW, $cropH, $imgX1, $imgY1)
            ->save(substr($image_url, 1));

        if( !$image) {

            return Response::json([
                'status' => 'error',
                'message' => 'Server error while uploading',
            ], 200);

        }

        return Response::json([
            'status' => 'success',
            'url' => $image_url,
        ], 200);

    }





    private function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

    private function createUniqueFilename( $filename , $upload_path)
    {
        $full_image_path = $upload_path . $filename . '.jpg';
        if ( File::exists( $full_image_path ) )
        {

            // Generate token for image
            $image_token = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $image_token;
        }

        return $filename;
    }



}
