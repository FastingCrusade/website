<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fast extends Commentable
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'start',
        'end',
        'description',
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
}
