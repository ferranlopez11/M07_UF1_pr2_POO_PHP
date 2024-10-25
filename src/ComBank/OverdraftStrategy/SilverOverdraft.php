<?php namespace ComBank\OverdraftStrategy;

use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;

class SilverOverdraft implements OverdraftInterface
{
    public function grantOverdraftFunds(float $amount): bool
    {
        return $amount <= 500.00;
    }

    public function getOverdraftFundsAmount(): float
    {
        return 500.00;
    }
}
