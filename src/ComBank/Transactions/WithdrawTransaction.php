<?php namespace ComBank\Transactions;


use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction implements BankTransactionInterface
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function applyTransaction(BankAccountInterface $account): float
    {
        $newBalance = $account->getBalance() - $this->amount;

        if ($newBalance < 0) {
            $overdraft = $account->getOverdraft();

            if (!$overdraft->grantOverdraftFunds(abs($newBalance))) {
                throw new InvalidOverdraftFundsException("Insufficient funds for withdrawal.");
            }
        }

        return $newBalance;
    }

    public function getTransactionInfo(): string
    {
        return "Withdrawal of " . $this->amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}