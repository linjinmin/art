<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 10/05/2017
 * Time: 23:16
 */

namespace DDL\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * DDL\Models\Bulletin
 *
 * @property int $id
 * @property string $title 标题
 * @property string $content 详情
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bulletin whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bulletin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bulletin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bulletin whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bulletin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bulletin extends Model
{

    protected $table = 'bulletin';

    protected $fillable = [
        'title',
        'content'
    ];


}