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
 * DDL\Models\Bug
 *
 * @property int $id
 * @property int $user_id user_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \DDL\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bug whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bug whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bug whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bug whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Bug whereUserId($value)
 * @mixin \Eloquent
 */
class Bug extends Model
{

    protected $table = 'bugs';

    protected $fillable = [
        'user_id',
        'content'
    ];


    /**
     * 属于用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}