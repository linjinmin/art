<?php

namespace DDL\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * DDL\Models\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $sex 性别
 * @property string $avatar 头像路径
 * @property string $nickname 微信昵称
 * @property string $status 用户状态, 0->禁用, 1->有效
 * @property string $last_login_ip 最近登录ip
 * @property string $role 用户角色, manager->超级管理员, painter->画家, member->会员
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $signature 个性签名
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereSignature($value)
 * @property string $remember_token 记住我
 * @property-read \DDL\Models\PainterApply $painterApply
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereRememberToken($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\DDL\Models\Painting[] $painting
 * @property int $image_id 图片id/头像
 * @property-read \DDL\Models\Image $image
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\User whereImageId($value)
 */
class User extends Authenticatable
{

    /**
     *  角色
     */
    const ROLE_MANAGER = 'manager';
    const ROLE_PAINTER = 'painer';
    const ROLE_MEMBER  = 'member';

    /**
     *  状态
     */
    const STATUS_USE = '1';
    const STATUS_FAILED = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_id',
        'email',
        'sex',
        'nickname',
        'signature',
        'status',
        'last_login_ip',
        'role',
        'password'
    ];


    /**
     * 用户申请
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function painterApply()
    {
        return $this->hasOne(PainerApply::class);
    }


    /**
     * 拥有很多画
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function painting()
    {
        return $this->hasMany(Painting::class);
    }


    /**
     * 头像
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }


    /**
     * bug反馈
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }


    /**
     * 用户消息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }



}
