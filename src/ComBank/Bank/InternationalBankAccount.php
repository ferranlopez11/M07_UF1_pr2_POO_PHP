<?php namespace ComBank\Bank;

use ComBank\Bank\BankAccount;

class InternationalBankAccout extends BankAccount
{
    public function getConvertedBalance(string $toCurrency): float {
        if ($this->currency === $toCurrency) {
            return $this->balance;
        }

        return $this->convertBalance($this->balance, $this->currency, $toCurrency);
    }
    public function getConvertedCurrency(): string
    {
    }
}