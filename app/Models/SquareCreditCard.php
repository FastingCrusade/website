<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-13
 * Time: 23:55
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SquareCreditCard
 *
 * @package App\Models
 */
class SquareCreditCard extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relationship to Subscriptions.
     *
     * @return MorphMany
     */
    public function subscriptions()
    {
        return $this->morphMany('App\Models\Subscription', 'payment_method');
    }
}
