<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 06/05/2017
 * Time: 21:09
 */

namespace DDL\Repositories;

use DB;
use DDL\Models\Painting;

class PaintingRepository extends BaseRepository
{

    public function __construct(Painting $painting) {
        $this->model = $painting;
    }



    /**
     * 根据分页获取数据
     */
    public function paintingGetByPage($page, $perpage)
    {
        $index = ($page-1) * $perpage;
        return DB::table('paintings')->select(['paintings.*', 'images.url'])->leftJoin('images', 'images.id', '=', 'paintings.image_id')->skip($index)->take($perpage)->get();
    }





}

