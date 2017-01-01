<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 16-Dec-16
 * Time: 00:40
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailSubscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'email',
    ];
}
