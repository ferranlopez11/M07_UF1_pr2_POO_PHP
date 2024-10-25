<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:24 PM
 */

use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\Support\Traits\AmountValidationTrait;

abstract class BaseTransaction
{
    protected $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function validateAmount(float $amount): void
    {
        if ($amount <= 0) {
            throw new ZeroAmountException("Amount must be greater than zero.");
        }
    }
    
}
