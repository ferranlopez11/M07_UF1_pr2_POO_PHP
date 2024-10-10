<?php

$balance = 0;
$status = "open";


//Functions to create, close and reopen the account
function createAccount() {
    global $balance, $status;
    $status = 'open';
    $balance = 200.0;
    return "My balance: $balance <br>";
}

function closeAccount() {
    global $status;
    if ($status === 'open') {
        $status = 'closed';
        return "My account is now closed. <br>";
    } else {
        return "Error: Account is already closed. <br>";
    }
}

function reopenAccount() {
    global $status;
    if ($status === 'closed') {
        $status = 'open';
        return "My account is now reopened. <br>";
    } else {
        return "Error: Account is already open. <br>";
    }
}

//Function to output the balance of the account
function getBalance() {
    global $balance, $status;
    if ($status === 'closed') {
        return "Error: Account closed. Cannot get balance. <br>";
    }
    return $balance;
}

//Function to deposit funds into the account
function deposit($amount) {
    global $balance, $status;
    if ($status === 'closed') {
        return "Error: Cannot deposit. The account is closed. <br>";
    }

    if ($amount <= 0) {
        return "Error transaction: Invalid deposit amount. <br>
        My balance after failed last transaction: $balance <br>";
    } else {
        $balance += $amount;
    }
    return "Doing transaction deposit (+$amount) with current balance " . $balance - $amount . " <br> 
    My new balance after deposit (+$amount): $balance <br>";
}


//Function to withdraw funds from the account
function withdrawal($amount) {
    global $balance, $status;
    if ($status === 'closed') {
        return "Error: Cannot withdraw. The account is closed. <br>";
    }

    if ($balance - $amount < 0) {
        if ($balance - $amount >= -120) {
            $balance -= $amount;
            return "Doing transaction withdrawal (-$amount) with current balance " . $balance + $amount . " <br>
            My new balance after withdrawal (-$amount) with funds: $balance <br>";
        } else {
            return "Doing transaction withdrawal (-$amount) with current balance " . $balance + $amount . " <br>
            Error transaction: Withdrawal excedes overdraft limit. <br>
            My balance after failed last transaction: $balance <br>";
        }    
    } elseif ($amount <= 0) {
        return "Error tansaction: Invalid withdrawal amount. <br>";
    } else {
        $balance -= $amount;
        return "Doing transaction withdrawal (-$amount) with current balance " . $balance + $amount . " <br> 
        My new balance after withdrawal (-$amount): $balance <br>";
    }
}


echo createAccount();

echo deposit(100);

echo withdrawal(300);

echo withdrawal(50);

echo withdrawal(120);

echo withdrawal(20);

echo closeAccount();

echo closeAccount();