<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 09/05/2017
 * Time: 12:04
 */

namespace DDL\Repositories;

use DDL\Models\Image;

class ImageRepository extends BaseRepository
{

    public function __construct(Image $image)
    {
        $this->model = $image;
    }


    /**
     * 获取用户默认头像
     * @return mixed
     */
    public function avatarDefault()
    {
        return $this->model->first();
    }


    /**
     * 通过url获取图片
     * @param Image $image
     * @param $url
     * @return Image|\Illuminate\Database\Query\Builder
     */
    public function imageUrlGet($url)
    {
        return $this->model->whereUrl($url)->first();
    }


}