<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-12
 * Time: 22:50
 */

namespace Testing;


use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;

class SubscriptionModel extends TestCase
{
    use DatabaseTransactions;

    public function testCreation()
    {
        $this->assertTrue(App::make('App\Models\Subscription') instanceof Subscription);
    }

    public function testUser()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        /** @var Subscription $subscription */
        $subscription = factory('App\Models\Subscription')->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($subscription->user() instanceof BelongsTo);
        $this->assertEquals($user->id, $subscription->user->id);
    }

    public function testPaymentMethodSquare()
    {
        /** @var SquareCreditCard $square */
        $square = factory('App\Models\SquareCreditCard')->create([]);
        /** @var Subscription $subscription */
        $subscription = factory('App\Models\Subscription')->create([
            'payment_method_id'   => $square->id,
            'payment_method_type' => 'App\Models\SquareCreditCard',
        ]);

        $this->assertTrue($subscription->paymentMethod() instanceof MorphTo);
        $this->assertEquals($square->id, $subscription->paymentMethod->id);
    }
}
