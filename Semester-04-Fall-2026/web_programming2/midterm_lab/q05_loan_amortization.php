<?php
$initialSavings = 500.00;
$monthlyDeposit = 150.00;

$loanBalance    = 1000.00;
$monthlyPayment = 300.00;

$attempt        = 1;
$maxAttempts    = 1; // Even if already at max, do...while executes body once

for ($month = 1; $month <= 6; $month++) {
    $initialSavings += $monthlyDeposit;

    echo "Month $month: $" . number_format($initialSavings, 2) . "<br>";
}

echo "<br><br>";

echo "Balance: " . $loanBalance . "<br>";
echo "Monthly payment: " . $monthlyPayment . "<br>";

$paymentCount = 0;


while ($loanBalance > 0) {
    $paymentCount++;

    $payment = $monthlyPayment;

    if ($loanBalance < $monthlyPayment) {
        $payment = $loanBalance;
    }

    $loanBalance -= $payment;

    echo "Payment [ $paymentCount ]: $" . number_format($payment) . "<br>";
    echo "Remaining balance: " . number_format($loanBalance) . "<br>";
}

echo "Loan paid off in $paymentCount month(s).";

echo "<br><br>";

do {
    echo "Diagnostic ping attempt #$attempt";
    $attempt++;
} while ($attempt <= $maxAttempts)

?>