<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 26-Nov-16
 * Time: 01:39
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id',
    ];

    /**
     * Relationship to User.
     *
     * This is the User that owns the Organization.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Relationship to Users.
     *
     * All the Users that are within this Organization.
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
