<?php namespace ComBank\Transactions\Contracts;


use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;

interface BankTransactionInterface
{
    public function applyTransaction(BankAccountInterface $bankAccount): float;

    public function getTransactionInfo(): string;

    public function getAmount(): float;
    
}
