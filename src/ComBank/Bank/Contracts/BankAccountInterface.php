<?php namespace ComBank\Bank\Contracts;


use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

interface BankAccountInterface
{
    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSED = 'CLOSED';

    public function transaction(BankTransactionInterface $transaction): void;

    public function isOpen(): bool;

    public function reopenAccount(): void;

    public function closeAccount(): void;

    public function getBalance(): float;

    public function getOverdraft(): OverdraftInterface;

    public function applyOverdraft(OverdraftInterface $overdraft): void;

    public function setBalance(float $balance): void;

}
