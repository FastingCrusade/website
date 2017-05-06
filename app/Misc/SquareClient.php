<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-15
 * Time: 22:48
 */

namespace App\Misc;


use App\Events\SquareConnect\ChargedCreditCard;
use App\Events\SquareConnect\FailedCreditCard;
use App\Models\SquareCreditCard;
use App\Models\TransactionLog;
use App\Models\User;
use Illuminate\Support\Facades\App;
use SquareConnect\Api\CustomerApi;
use SquareConnect\Api\CustomerCardApi;
use SquareConnect\Api\TransactionApi;
use SquareConnect\Model\Card;
use SquareConnect\Model\ChargeRequest;
use SquareConnect\Model\ChargeResponse;
use SquareConnect\Model\CreateCustomerCardRequest;
use SquareConnect\Model\CreateCustomerCardResponse;
use SquareConnect\Model\CreateCustomerRequest;
use SquareConnect\Model\CreateCustomerResponse;
use SquareConnect\Model\Customer;
use SquareConnect\Model\Error;
use SquareConnect\Model\Money;

/**
 * Class SquareClient
 *
 * Abstraction layer for the SquareConnect classes.
 * TODO The ->getErrors() thing is bull. The SquareConnect classes are letting exceptions escape. Use a try/catch.
 *
 * @package App\Misc
 */
class SquareClient
{
    /** @var Error[] $errors */
    private $errors = [];
    /** @var Customer $customer */
    private $customer;
    /** @var Card $card */
    private $card;

    /**
     * @return Card
     */
    public function card()
    {
        return $this->card;
    }

    /**
     * @return Customer
     */
    public function customer()
    {
        return $this->customer;
    }

    public function errors()
    {
        return collect($this->errors);
    }

    /**
     * @param User $user
     *
     * @return Customer
     */
    public function createCustomer(User $user)
    {
        /** @var CreateCustomerRequest $customer_request */
        $customer_request = App::make('SquareConnect\Model\CreateCustomerRequest');
        $customer_request->setEmailAddress($user->email);
        $customer_request->setGivenName($user->first_name);
        $customer_request->setFamilyName($user->last_name);

        /** @var CustomerApi $api */
        $api = App::make('SquareConnect\Api\CustomerApi');

        /** @var CreateCustomerResponse $response */
        $response = $api->createCustomer(
            config('services.square.access_token'),
            $customer_request
        );

        if ($response->getErrors()) {
            $this->errors[] = $response->getErrors();
        } else {
            $this->customer = $response->getCustomer();
        }

        return $this->customer;
    }

    /**
     * @param string        $nonce
     * @param Customer|null $customer
     *
     * @return Card
     */
    public function createCard(string $nonce, Customer $customer = null)
    {
        $customer = $customer ?: $this->customer;

        /** @var CreateCustomerCardRequest $card_request */
        $card_request = App::make('SquareConnect\Model\CreateCustomerCardRequest');
        $card_request->setCardNonce($nonce);

        /** @var CustomerCardApi $api */
        $api = App::make('SquareConnect\Api\CustomerCardApi');

        /** @var CreateCustomerCardResponse $response */
        $response = $api->createCustomerCard(
            config('services.square.access_token'),
            $customer->getId(),
            $card_request
        );

        if ($response->getErrors()) {
            $this->errors[] = $response->getErrors();
        } else {
            $this->card = $response->getCard();
        }

        return $this->card;
    }

    /**
     * @param SquareCreditCard $card
     * @param float            $amount
     * @param string           $currency
     *
     * @return bool|string
     */
    public function charge(SquareCreditCard $card, float $amount, $currency = 'USD')
    {
        $transaction_id = false;
        $idempotency_key = sha1(microtime(true) . $card->card_id . $card->customer_id);
        /** @var TransactionApi $api */
        $api = App::make('SquareConnect\Api\TransactionApi');

        /** @var Money $money */
        $money = App::make('SquareConnect\Model\Money');
        $money->setAmount($amount);
        $money->setCurrency($currency);

        /** @var ChargeRequest $charge_request */
        $charge_request = App::make('SquareConnect\Model\ChargeRequest');
        $charge_request->setCustomerCardId($card->card_id);
        $charge_request->setCustomerId($card->customer_id);
        $charge_request->setIdempotencyKey($idempotency_key);
        $charge_request->setAmountMoney($money);

        /** @var ChargeResponse $response */
        $response = $api->charge(
            config('services.square.access_token'),
            config('services.square.location_id'),
            $charge_request
        );

        TransactionLog::create([
            'idempotency_key' => $idempotency_key,
            'details'         => collect([
                'card_id'     => $card->card_id,
                'customer_id' => $card->customer_id,
            ]),
            'amount'          => $amount,
            'payment_method'  => get_class($this),
            'successful'      => empty($response->getErrors()),
        ]);

        if ($response->getErrors()) {
            $this->errors[] = $response->getErrors();
            event(new FailedCreditCard($card, $idempotency_key));
        } else {
            $transaction_id = $response->getTransaction()->getId();
            event(new ChargedCreditCard($card, $idempotency_key, $transaction_id));
        }

        return $transaction_id;
    }
}
