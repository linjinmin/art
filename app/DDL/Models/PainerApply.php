<?php

namespace DDL\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * DDL\Models\PainterApply
 *
 * @property-read \DDL\Models\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id 用户id
 * @property string $describe 自己的描述
 * @property string $url 图片路径
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PainerApply whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PainerApply whereDescribe($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PainerApply whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PainerApply whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PainerApply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PainerApply whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PainerApply whereUserId($value)
 * @property int $image_id 图片id
 * @property-read \DDL\Models\Image $image
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PainerApply whereImageId($value)
 */
class PainerApply extends Model
{

    protected $table = 'painer_apply';

    protected $fillable = [
        'user_id',
        'image_id',
        'describe',
    ];


    const STATUS_WAIT = '等待';
    const STATUS_PASS = '通过';
    const STATUS_REFUSE = '拒绝';

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



}
