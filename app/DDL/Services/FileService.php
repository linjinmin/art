<?php

/**
 * Created by PhpStorm.
 * User: lin
 * Date: 24/04/2017
 * Time: 18:02
 */

namespace DDL\Services;

use Image;

class FileService extends BaseService
{


    /**
     *  判断文件类型是否是图片类型
     *  @param string mimeType
     *  @return boolean
     */
    public function isImage($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }


    /**
     *  判断文件大小是否合理
     *  @param int size
     *  @param int legalSize
     *  @return boolean
     */
    public function legalSize($size, $legalSize)
    {
        if ($size > $legalSize) return false;
        return true;
    }


    /**
     * 不保留原图
     * @param $url
     * @param $height
     * @param $width
     */
    public function crop($url, $height, $width)
    {
        $img = Image::make($url)->resize($height,$width);
        $img->save($url);
    }


    /**
     * 保留原图
     * @param $url
     * @param $height
     * @param $width
     */
    public function cropByProportion($url, $heightPropotion, $widthPropotion)
    {
        $img = Image::make($url);
        $sUrl = str_replace('.' ,'S.' ,$url);
        $img->resize($img->height() * $heightPropotion, $img->width() * $widthPropotion)->save($sUrl);
    }


//    /**
//     * 根据type 查找上传文件路径
//     * @param $type
//     * @return string
//     */
//    public function findPath($type)
//    {
//        switch ($type){
//            case 1:
//                return static::PAINER_APPLY_PATH;
//                break;
//            case 2:
//                return static::PAINTING_PATH;
//                break;
//        }
//    }









}