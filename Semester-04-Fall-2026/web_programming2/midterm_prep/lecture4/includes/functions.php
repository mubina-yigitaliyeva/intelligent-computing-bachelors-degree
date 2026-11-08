<?php

function show_welcome() {
    echo 'Welcome to The Candy Store!';
}

function get_copyright() {
    $cur_year = date('Y');
    return "Copyright " . $cur_year;
}

function calculate_total($price, $quantity) {
    $total = $price * $quantity;
    $tax = $total * 0.2;
    $total += $tax;

    return $total;
}

function student_greeting($name) {
    $message = "Hello, " . $name;
    
    return $message;
}

function visit_count() {
    static $count = 0;

    $count++;

    return $count;
}

function cart_summary(array $prices) {
    $assoc_array = [
        'count' => count($prices),
        'total' => array_sum($prices)
    ];

    return $assoc_array;   
}

function check_grade(int $score) : string {
    if ($score >= 90) {
        return "Excellent";
    }

    if ($score >= 60) {
        return "Pass";
    }

    return "Fail";
}

function calculate_discount(float $price, float $discount = 0.10) : float {
    return $price - ($price * $discount);
}

function product_label(string $name, int $quantity = 1) : string {
    return $name . " - " . $quantity . " pack(s)";
}

/**
 * Removes leading and trailing whitespace and converts the string to uppercase.
 * @param string $name The original product name.
 * @return string The trimmed and uppercase product name.   
 */
function clean_product_name(string $name) : string {
    $clean_version = strtoupper(trim($name));

    return $clean_version;
}

/**
 * Calculates an average of an array of prices.
 * @param array $prices An array of numeric prices.
 * @return float The average price, or 0.0 if the array is empty.
 */
function calculate_average(array $prices) : float {

    if (!$prices) {
        return 0.0;
    }

    $array_sum = array_sum($prices);
    $arr_cnt = count($prices);

    return $array_sum / $arr_cnt;
}
?>