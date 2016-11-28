<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'first_name',
        'last_name',
    ];

    /**
     * Retrieves the full name of the User.
     *
     * @return string
     */
    public function fullName()
    {
        if ($this->first_name || $this->last_name) {
            $name = collect([$this->first_name, $this->last_name])->implode(' ');
        } else {
            $name = $this->email;
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

    /**
     * Relationship to Gender.
     *
     * @return BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function __toString()
    {
        $visible = json_decode(parent::__toString(), true);
        $visible['gender'] = [
            'id'   => $this->gender->id,
            'icon' => $this->gender->icon,
            'name' => $this->gender->name,
        ];

        return json_encode($visible, false);
    }
}
