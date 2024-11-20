<?php namespace ComBank\Bank;


use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class BankAccount implements BankAccountInterface
{
    protected float $balance;
    protected $status;
    protected $overdraft;

    
    protected string $currency;

    public function __construct(float $balance, string $currency = 'EUR') {
        $this->balance = $balance;
        $this->currency = $currency;
    }

    public function getBalance(): float {
        return $this->balance;
    }

    public function getCurrency(): string {
        return $this->currency;
    }


/*    public function __construct(float $initialBalance = 0.0)
    {
        $this->balance = $initialBalance;
        $this->status = self::STATUS_OPEN;
        $this->overdraft = new NoOverdraft();
    }*/

    public function isOpen(): bool
    {
        return $this->status === self::STATUS_OPEN;
    }

    public function reopenAccount(): void
    {
        if ($this->status === BankAccountInterface::STATUS_OPEN) {
            throw new BankAccountException("Account is already open.");
        }
        $this->status = BankAccountInterface::STATUS_OPEN;
        echo "<br>My account is now reopened.<br>";
    }
    
    public function closeAccount(): void
    {
        if ($this->status === BankAccountInterface::STATUS_CLOSED) {
            throw new BankAccountException("Account is already closed.");
        }
        $this->status = BankAccountInterface::STATUS_CLOSED;
        echo "<br>My account is now closed.<br>";
    }


    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

    public function transaction(BankTransactionInterface $transaction): void
    {
        if (!$this->isOpen()) {
            throw new BankAccountException("Account is closed.");
        }

        $this->balance = $transaction->applyTransaction($this);
    }

    public function getOverdraft(): OverdraftInterface
    {
        return $this->overdraft;
    }

    public function applyOverdraft(OverdraftInterface $overdraft): void
    {
        $this->overdraft = $overdraft;
    }

    
}
