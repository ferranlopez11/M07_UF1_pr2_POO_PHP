<?php

$balance = 0;
$status = "closed";


//Functions to create, close and reopen the account
function createAccount() {
    global $balance, $status;
    $status = 'open';
    $balance = 400.0;
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

    if ($amount > $balance) {
        return "Doing transaction withdrawal (-$amount) with current balance $balance <br>
        Error transaction: Insufficient balance to complete the withdrawal. <br>
        My balance after failed last transaction: $balance <br>";
    } elseif ($amount <= 0) {
        return "Error tansaction: Invalid withdrawal amount. <br>";
    } else {
        $balance -= $amount;
        return "Doing transaction withdrawal (-$amount) with current balance " . $balance + $amount . " <br> 
        My new balance after withdrawal (-$amount): $balance <br>";
    }
}


echo createAccount();

echo closeAccount();

echo reopenAccount();

echo deposit(150);

echo withdrawal(25);

echo withdrawal(600);

echo closeAccount();