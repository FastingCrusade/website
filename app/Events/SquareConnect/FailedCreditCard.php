<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-02-16
 * Time: 22:43
 */

namespace App\Events\SquareConnect;


use App\Models\SquareCreditCard;
use Illuminate\Queue\SerializesModels;

class FailedCreditCard
{
    use SerializesModels;

    /** @var SquareCreditCard $card */
    public $card;
    /** @var string $idempotency_key */
    public $idempotency_key;

    public function __construct(SquareCreditCard $card, string $idempotency_key)
    {
        $this->card = $card;
        $this->idempotency_key = $idempotency_key;
    }
}
