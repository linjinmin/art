<?php

namespace DDL\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * DDL\Models\Code
 *
 * @property int $id
 * @property string $email
 * @property string $code 验证码
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Code whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Code whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Code whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Code whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Code whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Code extends Model
{

    protected $table = 'code';



    protected  $fillable = [
        'email',
        'code'
    ];





}
