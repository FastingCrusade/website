<?php

namespace App\Models;

use App\Contracts\ImageHandler;
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
    /** @var ImageHandler $imageHandler */
    protected $imageHandler;

    public function __construct(ImageHandler $imageHandler, array $attributes)
    {
        parent::__construct($attributes);
        $this->imageHandler = $imageHandler;
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

    /**
     * Includes all information needed about the User in a JSON encoded string.
     *
     * @return string
     */
    public function __toString()
    {
        $visible = json_decode(parent::__toString(), true);
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

        return json_encode($visible, false);
    }

    /**
     * Returns the URL for the profile image.
     *
     * @return string
     */
    public function profileImageUrl()
    {
        return $this->imageHandler->url();
    }
}
