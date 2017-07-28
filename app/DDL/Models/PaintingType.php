<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 11/05/2017
 * Time: 16:57
 */

namespace DDL\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * DDL\Models\PaintingType
 *
 * @property int $id
 * @property string $name 类型名称
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PaintingType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PaintingType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PaintingType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\PaintingType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaintingType extends Model
{

    protected $table = 'painting_type';

    protected $fillable = [
        'name'
    ];





}