<?php
declare(strict_types=1);


function generateTicketNo(string $prefix = 'TKT') : string {
    static $num = 0;

    $num++;

    $res = $prefix . $num;

    return $res;
}

function calculateBookingTotal(float $ticketPrice, int $seats = 1, bool $isStudent = false) : float {
    $res = $ticketPrice * $seats;

    if ($isStudent) {
        $res *= 0.80;
    }

    return $res;
}