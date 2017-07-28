<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 14/05/2017
 * Time: 16:52
 */

namespace DDL\Models;

use DDL\Services\Mention;
use DDL\Services\Markdowner;
use Illuminate\Database\Eloquent\Model;

/**
 * DDL\Models\Comment
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property int $painting_id 作品id
 * @property string $content 评论
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \DDL\Models\Painting $painting
 * @property-read \DDL\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Comment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Comment wherePaintingId($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\DDL\Models\Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{


    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'painting_id',
        'content'
    ];


    /**
     * 属于用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * 属于作品
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function painting()
    {
        return $this->belongsTo(Painting::class);
    }


    /**
     * 数据处理
     * @param $value
     */
    public function setContentAttribute($value)
    {
        $content = (new Mention)->parse($value);

        $data = [
            'raw'  => $content,
            'html' =>str_replace('<a', '<a style="color: #16A085"', (new Markdowner)->convertMarkdownToHtml($content))
        ];

        $this->attributes['content'] = json_encode($data);
    }


    public function getContentAttribute($value)
    {
        $data = json_decode($value, true);
        return (new Markdowner)->convertMarkdownToHtml($data['html']);
    }




}