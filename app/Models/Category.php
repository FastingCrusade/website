<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 26-Nov-16
 * Time: 01:52
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id',
    ];

    /**
     * Relationship to Fasts.
     *
     * @return HasMany
     */
    public function fasts()
    {
        return $this->hasMany('App\Model\Fast');
    }
}
