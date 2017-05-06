<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-16
 * Time: 00:48
 */

namespace Testing;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Mockery;

class RegisterController extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware; // Should NOT be needed.

    public function testRegistration()
    {
        $mock_card = Mockery::mock('SquareConnect\Model\Card');
        $mock_card->shouldReceive('getId')->andReturn('aCardId');
        $mock_customer = Mockery::mock('SquareConnect\Model\Customer');
        $mock_customer->shouldReceive('getId')->andReturn('aCustomerId');
        $mock_client = Mockery::mock('App\Misc\SquareClient');
        $mock_client->shouldReceive('createCustomer')->andReturn($mock_customer);
        $mock_client->shouldReceive('createCard')->andReturn($mock_card);
        $mock_client->shouldReceive('charge')->andReturn('aTransactionId');
        App::instance('App\Misc\SquareClient', $mock_client);

        $this->post(
            '/register',
            [
                '_token'   => csrf_token(),
                'email'    => 'testEmail@fastingcrusade.com',
                'name'     => 'Test McTester',
                'nonce'    => 'someLongNonce',
                'password' => '123456',
            ]
        );

        $this->assertEquals(Response::HTTP_ACCEPTED, $this->response->getStatusCode(), 'Incorrect status code on response.');
        $this->seeJson([
            'success'        => 'OK',
//            'transaction_id' => 'aTransactionId',
        ]);
    }
}
