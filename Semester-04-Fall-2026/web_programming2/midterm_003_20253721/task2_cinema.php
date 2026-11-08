<?php
declare(strict_types=1);

require_once __DIR__ . "/task2_functions.php";

$res1 = calculateBookingTotal(
    ticketPrice: 12.00,
    seats: 2,
    isStudent:true
);

echo number_format($res1, 2) . " " .  generateTicketNo() . "<br>";

$res2 = calculateBookingTotal(
    ticketPrice: 12.00,
    isStudent: false
);

echo number_format($res2, 2) . " " . generateTicketNo() . "<br>";
