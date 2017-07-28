<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 21/05/2017
 * Time: 16:15
 */

namespace DDL\Repositories;

use DDL\Models\User;
use DDL\Models\Message;

class MessageRepository extends BaseRepository
{

    public function __construct(Message $message)
    {
        $this->model = $message;
    }


    /**
     * 添加数据
     * @param User $user
     * @param $content
     */
    public function add(User $user, $content)
    {
        $user->messages()->create(compact('content'));
    }


    /**
     * 后台审核画家申请消息
     * @param User $user
     * @param $status
     */
    public function painerAddByReview(User $user, $status)
    {

        switch ($status){
            case "通过":
                $content = config('ddl.message.painer_apply_review_pass');
                break;
            case "拒绝":
                $content = config('ddl.message.painer_apply_review_refuse');
                break;
            default:
                return;
                break;
        };

        $this->add($user, $content);
    }




}