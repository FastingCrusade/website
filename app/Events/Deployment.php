<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 24-Nov-16
 * Time: 19:30
 */

namespace App\Events;


use Illuminate\Queue\SerializesModels;

class Deployment
{
    use SerializesModels;

    public $time;
    public $delivery;

    public function __construct($delivery = 'Manual')
    {
        $this->time = time();
        $this->delivery = $delivery;
    }
}
