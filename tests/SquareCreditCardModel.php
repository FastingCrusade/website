<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-13
 * Time: 23:47
 */

namespace Testing;


use App\Models\SquareCreditCard;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SquareCreditCardModel extends TestCase
{
    use DatabaseTransactions;

    public function testSubscriptions()
    {
        /** @var SquareCreditCard $card */
        $card = factory('App\Models\SquareCreditCard')->create();
        /** @var Subscription $subscription */
        $subscription = factory('App\Models\Subscription')->create([
            'payment_method_id'   => $card->id,
            'payment_method_type' => 'App\Models\SquareCreditCard',
        ]);

        $this->assertTrue($card->subscriptions() instanceof MorphMany);
        $this->assertEquals($card->subscriptions->first()->id, $subscription->id);
    }
}
