<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Response;
use DDL\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DDL\Repositories\MessageRepository;

class UserController extends Controller
{

    use TableTrait;


    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function index(Request $request)
    {

        $filters = [
            'nickname' => [
                'type' => 'input',
                'label' => '用户名',
                'where' => function($query, $filter_name, $value) {
                    $query->where($filter_name, '=', $value);
                }
            ],


            'email' => [
                'type' => 'input',
                'label' => '邮箱',
                'where' => function($query, $filter_name, $value) {
                    $query->where($filter_name, '=', $value);
                }
            ],


            'status' => [
                'type' => 'select',
                'label' => '状态',
                'where' => '=',
                'options' => [
                    '所有状态' => null,
                    '禁用'   => User::STATUS_FAILED,
                    '使用'   => User::STATUS_USE
                ]
            ],


            'role' => [
                'type' => 'select',
                'label'=> '角色',
                'where'=> '=',
                'options' => [
                    '所有角色' => null,
                    User::ROLE_MEMBER => User::ROLE_MEMBER,
                    User::ROLE_PAINTER=> User::ROLE_PAINTER,
                    User::ROLE_MANAGER=> User::ROLE_MANAGER
                ]
            ],

        ];


        $trs = [

            '邮箱' => function(User $user){
                return $user->email;
            },

            '昵称' => function(User $user) {
                return $user->nickname;
            },

            '状态' => function(User $user) {
                return $user->status?'使用':'禁用';
            },

            '角色' => function(User $user){
                return $user->role;
            },

            '头像' => function(User $user) {
                return "
                    <img src=\"{$user->image->url}\" alt=\"\" height=\"50px\" width=\"50px\">
                ";
            },

            '禁用或者恢复使用' => function(User $user) {
                if ($user->status == User::STATUS_FAILED){
                    return "<button onclick='setStatus({$user->id}, 1)' class='btn  btn-xs btn-primary'>恢复使用</button>";
                } else {
                    if ($user->role != User::ROLE_MEMBER && $user->id != 1){
                        return "
                                <button onclick='setStatus({$user->id}, 0)' class='btn btn-xs  btn-danger' >禁用</button>
                                <button onclick='deprivation({$user->id})' class='btn btn-xs  btn-danger' >剥夺权利</button>
                                ";
                    } else {
                        return "<button onclick='setStatus({$user->id}, 0)' class='btn btn-xs  btn-danger' >禁用</button>";
                    }

                }
            }

        ];

        $objects = $this->getPaginate($request, User::whereRaw('1=1'), $filters);

        return view('admin.user.index')
                ->with('trs', $trs)
                ->with('filters', $filters)
                ->with('objects', $objects);

    }



    /**
     * 设置是否禁用
     */
    public function setStatus(User $user, $status)
    {

        if ($user->id == 1){
            return Response::json([
                'status' => 0,
                'info'   => '无权'
            ], 200);
        }

        $user->status = $status;
        $user->save();

        return Response::json([
            'status' => 1,
            'info'   => '操作成功'
        ], 200);
    }


    /**
     * 剥夺权利
     */
    public function deprivation(User $user)
    {
        if ($user->id == 1){
            return Response::json([
                'status' => 0,
                'info'   => '无权'
            ], 200);
        }

        DB::transaction(function() use ($user){
            $user->role = User::ROLE_MEMBER;
            $user->save();
            $this->messageRepository->add($user, config('ddl.message.deprivation'));
        });

        return Response::json([
            'status' => 1,
            'info'   => '操作成功'
        ], 200);

    }


    /**
     * 登出
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->to('/admin/auth/login');
    }


}
