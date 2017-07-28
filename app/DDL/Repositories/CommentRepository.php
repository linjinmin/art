<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 15/05/2017
 * Time: 00:15
 */

namespace DDL\Repositories;

use DDL\Models\Comment;

class CommentRepository extends BaseRepository {


    public function __construct(Comment $comment) {
        $this->model = $comment;
    }


    /**
     * 插入
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->save($this->model, $data);
    }


    /**
     * 插入
     * @param $model
     * @param $data
     * @return mixed
     */
    public function save($model, $data)
    {

        $model->fill($data);

        $model->save();

        return $model;
    }



}