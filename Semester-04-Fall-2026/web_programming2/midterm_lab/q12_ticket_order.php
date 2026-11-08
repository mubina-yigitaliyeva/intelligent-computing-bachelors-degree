<?php
$email = '';
$tickets = '';
$donation = '';
$message = '';
$invalid = ''; 
$total = 0.0; 

$errors = [
    'email' => '',
    'tickets' => '',
    'donation' => ''
];

$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($submitted) {
    $email = filter_input(INPUT_POST, 'email') ?? '';
    $tickets = filter_input(INPUT_POST, 'tickets') ?? '';
    $donation = filter_input(INPUT_POST, 'donation') ?? '';
    $donationValue = $donation === '' ? '0' : $donation;

    $options = [
        "options" => [
            'min_range' => 1,
            'max_range' => 5
        ]
    ];

    $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $valid_tickets = filter_var($tickets, FILTER_VALIDATE_INT, $options);
    $valid_donation = filter_var($donationValue, FILTER_VALIDATE_FLOAT);

    $errors['email'] = $valid_email === false
    ? 'invalid email' 
    : '';

    $errors['tickets'] = $valid_tickets === false
    ? 'tickets should be 1-5'
    : '';

    $errors['donation'] = (
        $valid_donation === false || 
        $valid_donation < 0 ||
        $valid_donation > 500
    )
    ? 'donation should be 0.0-500.0'
    : '';

    $invalid = implode($errors);
    $message = $invalid
    ? 'Please correct following errors.'
    : 'Valid data.';

    if (!$invalid) {
    $total = ($valid_tickets * 45.00) + $valid_donation;
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conference Ticket Reservation</title>
</head>
<body>

    <h2>Conference Ticket Reservation</h2>

    <?php if (!$submitted || $invalid) { ?>
        <form method="POST">

            <label for="email">Email:</label>
            <input
                type="text"
                name="email"
                id="email"
                value="<?= htmlspecialchars($email) ?>"
            >
            <p><?= htmlspecialchars($errors['email']) ?></p>

            <label for="tickets">Number of Tickets (1-5):</label>
            <input
                type="number"
                name="tickets"
                id="tickets"
                value="<?= htmlspecialchars($tickets) ?>"
            >
            <p><?= htmlspecialchars($errors['tickets']) ?></p>

            <label for="donation">Donation (optional, $0-$500):</label>
            <input
                type="number"
                name="donation"
                id="donation"
                step="0.01"
                value="<?= htmlspecialchars($donation) ?>"
            >
            <p><?= htmlspecialchars($errors['donation']) ?></p>

            <br>
            <button type="submit">Reserve Tickets</button>

            <p><?= htmlspecialchars($message) ?></p>

        </form>
    <?php } else { ?>
        <h3>Order Summary</h3>

        <p>Email: <?= htmlspecialchars($valid_email) ?></p>
        <p>Tickets: <?= $valid_tickets ?></p>
        <p>Total due: <?= number_format($total, 2) ?></p>
    <?php } ?>

    <br><br>

</body>
</html>
