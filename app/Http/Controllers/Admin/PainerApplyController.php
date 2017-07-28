<?php

namespace App\Http\Controllers\Admin;

use DB;
use DDL\Repositories\MessageRepository;
use DDL\Models\PainerApply;
use DDL\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PainerApplyController extends Controller
{

    use TableTrait;


    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }


    /**
     * 进入界面
     */
    public function index(Request $request)
    {
        $filters = [
            'status' => [
                'type' => 'select',
                'label'=> '状态',
                'where'=> '=',
                'options' => [
                    '所有状态' => null,
                    PainerApply::STATUS_WAIT => PainerApply::STATUS_WAIT,
                    PainerApply::STATUS_PASS => PainerApply::STATUS_PASS,
                    PainerApply::STATUS_REFUSE => PainerApply::STATUS_REFUSE
                ]
            ]
        ];


        $trs = [
            '邮箱' => function(PainerApply $apply) {
                return $apply->user->email;
            },

            '昵称' => function(PainerApply $apply) {
                return $apply->user->nickname;
            },

            '状态' => function(PainerApply $apply) {
                return $apply->status;
            },

            '操作' => function(PainerApply $apply) {
                return "
                        <a class='btn btn-xs btn-primary ' href='/admin/apply/show/{$apply->id}'>详情</a>
                        ";
            },

        ];


        $objects = $this->getPaginate($request, PainerApply::whereRaw('1=1'), $filters);

        return view('admin.painerapply.index')
                ->with('objects', $objects)
                ->with('trs', $trs)
                ->with('filters', $filters);

    }


    /**
     * 详情界面
     */
    public function show(PainerApply $apply)
    {
        return view('admin.painerapply.show')->with('apply', $apply);
    }


    /**
     * 审核
     * @param PainerApply $apply
     * @param $status
     * @return mixed
     */
    public function  review(PainerApply $apply, $status)
    {
        switch ($status){
            case '1' :
                $applyStatus = '通过';
                break;
            case  '-1':
                $applyStatus = '拒绝';
                break;
            default:
                $applyStatus = '等待';
                break;
        };

        DB::transaction(function() use($apply, $applyStatus) {
            $apply->status = $applyStatus;
            $apply->save();
            if ($apply->status == PainerApply::STATUS_PASS){
                $apply->user->role = User::ROLE_PAINTER;
                $apply->user->save();
            }
            $this->messageRepository->painerAddByReview($apply->user, $applyStatus);
        });


        return redirect()->back()->withMessage(['success'=>'操作成功']);
    }


}
