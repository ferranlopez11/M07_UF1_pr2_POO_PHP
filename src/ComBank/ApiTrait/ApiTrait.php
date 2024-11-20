<?php namespace ComBank\ApiTrait;

use ComBank\Transactions\Contracts\BankTransactionInterface;
use ComBank\Transactions\DepositTransaction;
use ComBank\Transactions\WithdrawTransaction;

trait ApiTrait {
    public function validateEmail(String $email): bool
    {

    }

    public function convertBalance(float $amount, string $from, string $to): float {
        $rate = $this->getConversionRate($from, $to);
        return $amount * $rate;
    }

    public function getConversionRate(string $from, string $to): float {
        // Simulación de API externa, puede adaptarse con una petición HTTP real usando cURL o file_get_contents.
        $rates = [
            'EUR_TO_USD' => 1.10,
            'USD_TO_EUR' => 0.91
        ];

        $key = strtoupper($from . '_TO_' . $to);
        if (isset($rates[$key])) {
            return $rates[$key];
        }

        throw new Exception("Conversion rate not available for $from to $to");
    }

    public function detectFraud(BankTransactionInterface $fraud): bool
    {

    }
}