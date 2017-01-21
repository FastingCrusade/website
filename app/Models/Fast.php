<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fast
 *
 * @package App\Models
 */
class Fast extends Commentable
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'start',
        'end',
        'description',
        'subtype',
    ];

    protected $dates = [
        'created_at',
        'deleted_at',
        'updated_at',
        'start',
        'end',
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    /**
     * Relationship to User.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Relationship to Category.
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Relationship to the Comments.
     *
     * @return MorphMany
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    /**
     * Converts the object into an Array representation.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['start'] = $this->start->timestamp;
        $array['end'] = $this->end->timestamp;

        return $array;
    }
}
