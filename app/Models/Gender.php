<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 27-Nov-16
 * Time: 01:14
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use SoftDeletes;

    /**
     * Relationship to Users.
     *
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
