<?php

/**
 * Created by PhpStorm.
 * User: lin
 * Date: 24/04/2017
 * Time: 18:00
 */

namespace DDL\Repositories;


class BaseRepository {

    protected $model;

    public function __call($name, $arguments) {
        // TODO: Implement __call() method.
        return call_user_func_array([$this->model, $name], $arguments);
    }

}