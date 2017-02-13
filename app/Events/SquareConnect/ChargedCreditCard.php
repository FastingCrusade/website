<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-16
 * Time: 22:30
 */

namespace App\Events\SquareConnect;


use App\Models\SquareCreditCard;
use Illuminate\Queue\SerializesModels;

class ChargedCreditCard
{
    use SerializesModels;

    /** @var SquareCreditCard $card */
    public $card;
    /** @var string $transaction_id */
    public $transaction_id;
    /** @var string $idempotency_key */
    public $idempotency_key;

    public function __construct(SquareCreditCard $card, string $idempotency_key, string $transaction_id)
    {
        $this->card = $card;
        $this->idempotency_key = $idempotency_key;
        $this->transaction_id = $transaction_id;
    }
}
