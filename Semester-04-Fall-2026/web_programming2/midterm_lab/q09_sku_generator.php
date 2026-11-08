<?php
$rawItems = [
    ['name' => '  ergonomic mouse ', 'category' => 'Peripherals'],
    ['name' => '4k gaming monitor',  'category' => 'Monitors'],
    ['name' => 'usb-c hub adapter',  'category' => 'Accessories'],
    ['name' => 'nvme ssd 1tb',       'category' => 'Storage']
];

function generateNextSku(string $category, string $prefix = 'WH') : string {
    static $sequence = 0;

    $sequence++;

    $clean_category = substr(strtoupper(trim($category)), 0, 3);

    $padded_sequence = str_pad((string) $sequence, 3, '0', STR_PAD_LEFT);

    return implode('-', [$prefix, $clean_category, $padded_sequence]);
}

foreach ($rawItems as $rawItem) {
    $cleanned_name = trim($rawItem['name']);
    $category = generateNextSku($rawItem['category']);

    echo $cleanned_name . ": " . $category;

    echo "<br>";
}

?>