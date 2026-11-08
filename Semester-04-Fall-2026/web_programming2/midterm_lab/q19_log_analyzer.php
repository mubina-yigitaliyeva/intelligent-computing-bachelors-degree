<?php
declare(strict_types=1);

require_once __DIR__ . '/q19_functions.php';

// Example log data
$logs = [
    [
        'method' => 'GET',
        'path' => '/index.php',
        'status' => 200,
        'ms' => 45
    ],
    [
        'method' => 'POST',
        'path' => '/login.php',
        'status' => 401,
        'ms' => 350
    ],
    [
        'method' => 'GET',
        'path' => '/products.php',
        'status' => 200,
        'ms' => 180
    ],
    [
        'method' => 'POST',
        'path' => '/checkout.php',
        'status' => 500,
        'ms' => 1250
    ],
    [
        'method' => 'GET',
        'path' => '/contact.php',
        'status' => 404,
        'ms' => 95
    ]
];

// Allowed methods
$allowedMethods = ['ALL', 'GET', 'POST'];

$warnings = [];

// Read GET parameters
$method = $_GET['method'] ?? 'ALL';
$minMsInput = $_GET['min_ms'] ?? '0';

// Validate method
if (!in_array($method, $allowedMethods, true)) {
    $method = 'ALL';
    $warnings[] = 'Invalid method. Using ALL.';
}

// Validate minimum response time
$minMs = filter_var(
    $minMsInput,
    FILTER_VALIDATE_INT,
    [
        'options' => [
            'min_range' => 0,
            'max_range' => 5000
        ]
    ]
);

if ($minMs === false) {
    $minMs = 0;
    $warnings[] = 'Invalid minimum time. Using 0.';
}

// Filter logs using named arguments
$filteredLogs = filterLogs(
    logs: $logs,
    method: $method,
    minMs: $minMs
);

// Calculate average response time
$totalMs = 0;

foreach ($filteredLogs as $log) {
    $totalMs += $log['ms'];
}

$matchingEntries = count($filteredLogs);

$averageMs = $matchingEntries > 0
    ? $totalMs / $matchingEntries
    : 0.0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Server Access Log Analyzer</title>
</head>
<body>

    <h2>Server Access Log Analyzer</h2>

    <form method="GET">

        <label for="method">HTTP Method:</label>

        <select name="method" id="method">

            <?php foreach ($allowedMethods as $option) { ?>

                <option
                    value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"
                    <?= $method === $option ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        <label for="min_ms">Minimum Response Time (ms):</label>

        <input
            type="number"
            name="min_ms"
            id="min_ms"
            min="0"
            max="5000"
            value="<?= htmlspecialchars((string)$minMs, ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <button type="submit">Filter Logs</button>

    </form>

    <?php foreach ($warnings as $warning) { ?>
        <p>
            <?= htmlspecialchars($warning, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php } ?>

    <h3>Results</h3>

    <p>
        Matching Entries: <?= $matchingEntries ?>
        |
        Average Response Time:
        <?= number_format($averageMs, 1) ?> ms
    </p>

    <table border="1" cellpadding="10">

        <tr>
            <th>Method</th>
            <th>Path</th>
            <th>Status</th>
            <th>Status Badge</th>
            <th>Response Time (ms)</th>
        </tr>

        <?php foreach ($filteredLogs as $log) { ?>

            <tr>
                <td>
                    <?= htmlspecialchars($log['method'], ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars($log['path'], ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= $log['status'] ?>
                </td>

                <td>
                    <?= htmlspecialchars(getStatusBadge($log['status']), ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= $log['ms'] ?>
                </td>
            </tr>

        <?php } ?>

    </table>

    <?php if ($matchingEntries === 0) { ?>
        <p>No matching log entries found.</p>
    <?php } ?>

</body>
</html>
