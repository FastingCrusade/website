<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 26-Nov-16
 * Time: 01:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 *
 * @package App\Models
 */
class Comment extends Commentable
{
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    /**
     * The object to which the Comment is "posted" to.
     *
     * @return MorphTo
     */
    public function parent()
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
