<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 15/05/2017
 * Time: 00:12
 */

namespace DDL\Services;


use DDL\Repositories\CommentRepository;
use DDL\Repositories\PaintingRepository;

class PaintingService extends BaseService
{

    protected $commentRepository;
    protected $paintingRepository;

    public function __construct(PaintingRepository $paintingRepository, CommentRepository $commentRepository) {
        $this->commentRepository = $commentRepository;
        $this->paintingRepository = $paintingRepository;
    }


    /**
     * 作品展示获取数据
     * @param $painting_id
     * @return array
     */
    public function paintingShow($painting_id)
    {
        $painting = $this->paintingRepository->find($painting_id);
        $comments = $this->commentRepository->where('painting_id', '=', $painting_id)->get();
        return [$painting, $comments];
    }







}