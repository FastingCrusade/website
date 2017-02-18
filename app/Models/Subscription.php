<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-12
 * Time: 22:51
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'deleted_at',
        'updated_at',
        'expires_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relationship to the User.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Relationship to the payment method (polymorphic).
     *
     * @return MorphTo
     */
    public function paymentMethod()
    {
        return $this->morphTo();
    }
}
