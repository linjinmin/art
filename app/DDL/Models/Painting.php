<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 05/05/2017
 * Time: 17:39
 */

namespace DDL\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * DDL\Models\Painting
 *
 * @property int $id
 * @property int $user_id 关联用户id
 * @property string $title 标题
 * @property string $introduction 简介
 * @property string $url 原图片路径
 * @property string $url_crop 压缩图片路径
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \DDL\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereIntroduction($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereUrlCrop($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereUserId($value)
 * @mixin \Eloquent
 * @property int $image_id 图片id
 * @property-read \DDL\Models\Image $image
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting whereImageId($value)
 * @property int $painting_type_id 图片类型
 * @property-read \DDL\Models\PaintingType $paintingType
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Painting wherePaintingTypeId($value)
 */
class Painting extends Model
{

    protected $table = "paintings";

    protected $fillable = [
        'user_id',
        'image_id',
        'painting_type_id',
        'title',
        'introduction'
    ];



    /**
     * 属于用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * 图片
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }


    /**
     * 作品类型
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paintingType()
    {
        return $this->hasOne(PaintingType::class, 'id', 'painting_type_id');
    }





}