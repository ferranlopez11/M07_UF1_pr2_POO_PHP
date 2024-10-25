<?php namespace ComBank\OverdraftStrategy\Contracts;


interface OverdraftInterface
{
    public function grantOverdraftFunds(float $amount): bool;
    public function getOverdraftFundsAmount(): float;
   
}
