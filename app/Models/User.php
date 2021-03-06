<?php

namespace App\Models;

use App\Contracts\ImageHandler;
use App\ImageHandlers\Gravatar;
use App\Misc\Size;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
    /** @var ImageHandler $imageHandler */
    protected $imageHandler;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->imageHandler = App::make('App\Contracts\ImageHandler');
        $this->imageHandler->setDefault(Gravatar::MYSTERY);
    }

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

        return trim($name);
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
        return $this->hasMany('App\Models\Fast');
    }

    /**
     * Relationship to Gender.
     *
     * @return BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo('App\Models\Gender')->withTrashed();
    }

    /**
     * Relationship to the Subscription
     *
     * @return HasOne
     */
    public function subscription()
    {
        return $this->hasOne('App\Models\Subscription');
    }

    /**
     * Includes all information needed about the User in a JSON encoded string.
     *
     * @return string
     */
    public function jsonSerialize()
    {
        $visible = $this->toArray();
        $visible['full_name'] = $this->fullName();
        $visible['profile_image_url'] = $this->profileImageUrl();

        if (!$this->gender) {
            $this->gender()->associate(Gender::find(Gender::UNKNOWN));
        }

        $visible['gender'] = [
            'id'   => $this->gender->id,
            'icon' => $this->gender->icon,
            'name' => $this->gender->name,
        ];

        if (Auth::user() && (Auth::user()->id === $this->id || Auth::user()->is_admin)) {
            $visible['api_token'] = $this->api_token;
        }

        return json_encode($visible, false);
    }

    /**
     * Returns the URL for the profile image.
     *
     * @return string
     */
    public function profileImageUrl()
    {
        return $this->imageHandler->url($this->email);
    }
}
