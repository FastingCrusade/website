<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-16
 * Time: 00:45
 */

namespace Testing;


use App\Events\SquareConnect\ChargedCreditCard;
use App\Events\SquareConnect\FailedCreditCard;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;
use Mockery;
use SquareConnect\Model\Card;
use SquareConnect\Model\Customer;

class SquareClient extends TestCase
{
    use DatabaseTransactions;

    public function testExistence()
    {
        $this->assertTrue(App::make('App\Misc\SquareClient') instanceof \App\Misc\SquareClient);
    }

    public function testCreateCustomer()
    {
        $mock_response = Mockery::mock('SquareConnect\Model\CreateCustomerResponse')->shouldDeferMissing();
        $mock_response->shouldReceive('getCustomer')->once()->andReturn(App::make('SquareConnect\Model\Customer'));
        $mock_square_api = Mockery::mock('SquareConnect\Api\CustomerApi')->shouldDeferMissing();
        $mock_square_api->shouldReceive('createCustomer')
            ->once()
            ->andReturn($mock_response);
        App::instance('SquareConnect\Api\CustomerApi', $mock_square_api);

        /** @var \App\Misc\SquareClient $api */
        $api = App::make('App\Misc\SquareClient');
        /** @var Customer $customer */
        $customer = $api->createCustomer(factory('App\Models\User')->make());

        $this->assertTrue($customer instanceof Customer);
        $this->assertEquals($customer->getId(), $api->customer()->getId());
    }

    public function testCreateCustomerWithError()
    {
        $mock_response = Mockery::mock('SquareConnect\Model\CreateCustomerResponse')->shouldDeferMissing();
        $mock_response->shouldReceive('getErrors')->twice()->andReturn('A fake error.');
        $mock_square_api = Mockery::mock('SquareConnect\Api\CustomerApi')->shouldDeferMissing();
        $mock_square_api->shouldReceive('createCustomer')
            ->once()
            ->andReturn($mock_response);
        App::instance('SquareConnect\Api\CustomerApi', $mock_square_api);

        /** @var \App\Misc\SquareClient $api */
        $api = App::make('App\Misc\SquareClient');
        /** @var Customer $customer */
        $customer = $api->createCustomer(factory('App\Models\User')->make());

        $this->assertFalse($customer instanceof Customer);
        $this->assertContains('A fake error.', $api->errors());
    }

    public function testCreateCard()
    {
        $mock_customer = Mockery::mock('SquareConnect\Model\Customer')->shouldDeferMissing();
        $mock_customer->shouldReceive('getId')->andReturn('myId');

        $mock_customer_response = Mockery::mock('SquareConnect\Model\CreateCustomerResponse')->shouldDeferMissing();
        $mock_customer_response->shouldReceive('getCustomer')->once()->andReturn($mock_customer);

        $mock_card_response = Mockery::mock('SquareConnect\Model\CreateCustomerCardResponse')->shouldDeferMissing();
        $mock_card_response->shouldReceive('getCard')->once()->andReturn(App::make('SquareConnect\Model\Card'));

        $mock_customer_api = Mockery::mock('SquareConnect\Api\CustomerApi')->shouldDeferMissing();
        $mock_customer_api->shouldReceive('createCustomer')
            ->once()
            ->andReturn($mock_customer_response);

        $mock_card_api = Mockery::mock('SquareConnect\Api\CustomerCardApi')->shouldDeferMissing();
        $mock_card_api->shouldReceive('createCustomerCard')
            ->once()
            ->andReturn($mock_card_response);

        App::instance('SquareConnect\Api\CustomerApi', $mock_customer_api);
        App::instance('SquareConnect\Api\CustomerCardApi', $mock_card_api);

        /** @var \App\Misc\SquareClient $client */
        $client = App::make('App\Misc\SquareClient');
        $client->createCustomer(factory('App\Models\User')->make());
        $card = $client->createCard('nonce');

        $this->assertTrue($card instanceof Card);
        $this->assertEquals($card->getId(), $client->card()->getId());
    }

    public function testCreateCardWithError()
    {
        $mock_customer = Mockery::mock('SquareConnect\Model\Customer')->shouldDeferMissing();
        $mock_customer->shouldReceive('getId')->andReturn('myId');

        $mock_customer_response = Mockery::mock('SquareConnect\Model\CreateCustomerResponse')->shouldDeferMissing();
        $mock_customer_response->shouldReceive('getCustomer')->once()->andReturn($mock_customer);

        $mock_card_response = Mockery::mock('SquareConnect\Model\CreateCustomerCardResponse')->shouldDeferMissing();
        $mock_card_response->shouldReceive('getErrors')->twice()->andReturn('A fake error.');

        $mock_customer_api = Mockery::mock('SquareConnect\Api\CustomerApi')->shouldDeferMissing();
        $mock_customer_api->shouldReceive('createCustomer')
            ->once()
            ->andReturn($mock_customer_response);

        $mock_card_api = Mockery::mock('SquareConnect\Api\CustomerCardApi')->shouldDeferMissing();
        $mock_card_api->shouldReceive('createCustomerCard')
            ->once()
            ->andReturn($mock_card_response);

        App::instance('SquareConnect\Api\CustomerApi', $mock_customer_api);
        App::instance('SquareConnect\Api\CustomerCardApi', $mock_card_api);

        /** @var \App\Misc\SquareClient $client */
        $client = App::make('App\Misc\SquareClient');
        $client->createCustomer(factory('App\Models\User')->make());
        $card = $client->createCard('nonce');

        $this->assertFalse($card instanceof Card);
        $this->assertContains('A fake error.', $client->errors());
    }

    public function testCharge()
    {
        $this->expectsEvents(ChargedCreditCard::class);

        $mock_transaction = Mockery::mock('SquareConnect\Model\Transaction')->shouldDeferMissing();
        $mock_transaction->shouldReceive('getId')->once()->andReturn('myId');
        $mock_response = Mockery::mock('SquareConnect\Model\ChargeResponse')->shouldDeferMissing();
        $mock_response->shouldReceive('getErrors')->twice()->andReturn(null);
        $mock_response->shouldReceive('getTransaction')->once()->andReturn($mock_transaction);
        $mock_api = Mockery::mock('SquareConnect\Api\TransactionApi')->shouldDeferMissing();
        $mock_api->shouldReceive('charge')->once()->andReturn($mock_response);
        App::instance('SquareConnect\Api\TransactionApi', $mock_api);

        /** @var \App\Misc\SquareClient $client */
        $client = App::make('App\Misc\SquareClient');
        $transaction_id = $client->charge(factory('App\Models\SquareCreditCard')->make(), 15);

        $this->assertEquals('myId', $transaction_id);
    }

    public function testChargeWithError()
    {
        $this->expectsEvents(FailedCreditCard::class);

        $mock_response = Mockery::mock('SquareConnect\Model\ChargeResponse')->shouldDeferMissing();
        $mock_response->shouldReceive('getErrors')->times(3)->andReturn('myError');
        $mock_api = Mockery::mock('SquareConnect\Api\TransactionApi')->shouldDeferMissing();
        $mock_api->shouldReceive('charge')->once()->andReturn($mock_response);
        App::instance('SquareConnect\Api\TransactionApi', $mock_api);

        /** @var \App\Misc\SquareClient $client */
        $client = App::make('App\Misc\SquareClient');
        $transaction_id = $client->charge(factory('App\Models\SquareCreditCard')->make(), 15);

        $this->assertEquals(false, $transaction_id);
    }
}
