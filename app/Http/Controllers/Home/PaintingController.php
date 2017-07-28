<?php

namespace App\Http\Controllers\Home;

use DB;
use Auth;
use Response;
use DDL\Models\User;
use DDL\Models\PaintingType;
use Illuminate\Http\Request;
use DDL\Services\PaintingService;
use App\Http\Controllers\Controller;
use DDL\Repositories\ImageRepository;
use DDL\Repositories\MessageRepository;
use DDL\Repositories\CommentRepository;
use DDL\Repositories\PaintingRepository;

class PaintingController extends Controller
{

    protected $imageRepository;
    protected $commentRepository;
    protected $paintingRepository;
    protected $paintingService;
    protected $messageRepository;


    public function __construct(PaintingRepository $paintingRepository,
                                ImageRepository $imageRepository,
                                CommentRepository $commentRepository,
                                PaintingService $paintingService,
                                MessageRepository $messageRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->commentRepository = $commentRepository;
        $this->paintingRepository = $paintingRepository;
        $this->paintingService = $paintingService;
        $this->messageRepository = $messageRepository;
    }


    /**
     *  发表作品界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRelease()
    {
        return view('home.painting.release');
    }


    /**
     * 发表作品
     * @param Request $request
     * @return mixed
     */
    public function release(Request $request)
    {
        $this->validate($request, [
            'url' => 'required',
            'title' => 'required|max:50',
            'introduction' => 'required|max:255',
        ]);

        $user = Auth::user();

        if ($user->role != User::ROLE_PAINTER){
            return redirect()->back()->withErrors('无效的请求');
        }

        $image = $this->imageRepository->imageUrlGet($request->input('url'));
        if (empty($image)){
            return redirect()->back()->withErrors('服务器发生错误');
        }

        // 获取默认类型
        $type = PaintingType::whereName($request->input('type')?:"所有")->first();

        DB::transaction(function() use($user, $request, $image, $type){
            $user->painting()->create([
                'image_id' => $image->id,
                'title'    => $request->input('title'),
                'introduction' => $request->input('introduction'),
                'painting_type_id' => $type->id
            ]);

            $this->messageRepository->add($user, config('ddl.message.release') . $request->input('title') . '>>');
        });

        return redirect()->back()->withMessage(['success'=>'发表作品成功']);
    }


    /**
     * 作品详情
     * @param $painting_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($painting_id)
    {
        list($painting, $comments) = $this->paintingService->paintingShow($painting_id);
        return view('home.painting.show')
                ->with('painting', $painting)
                ->with('comments', $comments)
                ->with('works',    $painting->user->painting);

    }


    /**
     * 发表评论
     * @param Request $request
     * @return mixed
     */
    public function comment(Request $request)
    {

        $this->validate($request, [
            'painting_id' => 'required|integer',
            'content' => 'required|max:100'
        ]);

        $data = array_merge(
            $request->all(),
            ['user_id' => Auth::user()->id]
        );

        $this->commentRepository->store($data);

        return redirect()->back()->withMessage(['success'=>'发表评论成功']);
    }


    /**
     * 作品界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWork()
    {
        $page = 1;
        $paintings = $this->paintingRepository->paintingGetByPage($page, config('ddl.painting_perpage'));
        return view('home.painting.work')->with('paintings', $paintings);
    }


    /**
     * 加载更多
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function workAjax($page)
    {
        $paintings = $this->paintingRepository->paintingGetByPage($page, config('ddl.painting_perpage'));
        return Response::json([
            'paintings' => $paintings
        ],200);
    }


}
