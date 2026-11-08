<?php
    $number = null;
    $message = '';
    $options = [
        'options' => [
            'min_range' => 0,
            'max_range' => 255
        ],
        'flags' => FILTER_FLAG_ALLOW_HEX
    ];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $number = filter_input(INPUT_POST, 
                                'number', 
                                FILTER_VALIDATE_INT, 
                                $options);

        // if ($number === false || $number === null) {
        //     $message = "Invalid number or number is missing.";
        // } else {
        //     $message = "Valid number: " . $number;
        // }
        
        $message = ! is_int($number ?? null)
        ? "Invalid number or number is missing."
        : "Valid number: " . $number;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Number validator</h1>

    <form method="POST">
        <label for="number">Enter a decimal or hexadecimal integer (0-255):</label>
        <input type="text" name="number" id="number" value="<?= is_int($number) ? $number : '' ?>">

        <button type="submit">Submit</button>
    </form>

    <?php if ($message) { ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php } ?>
</body>
</html>