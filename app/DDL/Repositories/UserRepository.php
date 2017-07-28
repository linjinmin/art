<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 24/04/2017
 * Time: 22:08
 */

namespace DDL\Repositories;

use DDL\Models\User;

class UserRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }



    public function painerApplyGet(User $user)
    {
        return $user->painterApply();
    }


    public function painerApplyGetByStatus(User $user, $status)
    {
        return $this->painerApplyGet($user)->whereStatus($status);
    }


}