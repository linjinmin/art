<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 08/05/2017
 * Time: 17:28
 */

namespace DDL\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * DDL\Models\Image
 *
 * @property int $id
 * @property string $url 原图片路径
 * @property string $url_crop 压缩图片路径
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Image whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Image whereUrlCrop($value)
 * @mixin \Eloquent
 */
class Image extends Model
{

    protected $table = 'images';

    protected $fillable = [
        'url',
    ];


    public static $rules = [
        'img' => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ];


    public static $messages = [
        'img.mimes' => 'Uploaded file is not in image format',
        'img.required' => 'Image is required',
    ];


    // 最大文件上传
    const FILE_MAX = 9437184;


    // 用户头像宽高
    const USER_HEIGHT = 106;
    const USER_WIDTH  = 106;

    // 作品宽高
    const PAINTING_HEIGHT = 1200;
    const PAINTING_WIDTH  = 1920;

    // 作品压缩宽高 比
    const PAINTING_PROPORTION = 0.3;



    //  申请成为作家
    const PAINER_APPLY_PATH = 'uploads/apply/';
    // 发表作品
    const PAINTING_PATH     = 'uploads/painting/';
    // 用户头像
    const AVATAR_PATH       = 'uploads/user/';



}