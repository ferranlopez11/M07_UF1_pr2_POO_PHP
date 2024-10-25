<?php namespace ComBank\Transactions;


use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class DepositTransaction implements BankTransactionInterface
{
    private $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function applyTransaction(BankAccountInterface $account): float
    {
        $newBalance = $account->getBalance() + $this->amount;
        return $newBalance;
    }

    public function getTransactionInfo(): string
    {
        return "Deposit of " . $this->amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
   
}
