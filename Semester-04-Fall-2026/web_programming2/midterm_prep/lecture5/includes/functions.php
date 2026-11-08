<?php

function is_number($number, $min = 0, $max = 100) {
    return (is_numeric($number) && 
            $min <= $number &&
            $max >= $number);
}

function is_text($text, $min = 0, $max = 1000) {
    $length = mb_strlen($text);
    return $min <= $length && $length <= $max;
}

function is_valid_password($password) {
    return (
            mb_strlen($password) >= 8 &&
            preg_match('/[A-Z]/', $password) &&
            preg_match('/[a-z]/', $password) && 
            preg_match('/[0-9]/', $password)
        );
}

?>