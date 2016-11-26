<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'name',
    ];

    /**
     * Retrieves the full name of the User.
     *
     * @return string
     */
    public function fullName()
    {
        $name = '';

        if ($this->first_name || $this->last_name) {
            $name = collect([$this->first_name, $this->last_name])->implode(' ');
        }

        return $name;
    }

    /**
     * Relationship to Organizations.
     *
     * @return BelongsToMany
     */
    public function organizations()
    {
        return $this->belongsToMany('App\Models\Organization');
    }

    /**
     * Relationship to Comments.
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Relationship to Fasts.
     *
     * @return HasMany
     */
    public function fasts()
    {
        return $this->hasMany('App\Models\Fasts');
    }
}
