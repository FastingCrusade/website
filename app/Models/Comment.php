<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 26-Nov-16
 * Time: 01:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Commentable
{
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function parent()
    {
        return $this->morphTo();
    }
}
