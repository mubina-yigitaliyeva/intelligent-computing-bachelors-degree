<?php
declare(strict_types=1);

function getStatusBadge(int $status) : string {
    $message = match(true) {
        $status >= 500 => 'CRITICAL (5xx)',
        $status >= 400 => 'WARNING (4xx)',
        $status >= 200 => 'OK (2xx)',
        default => 'INFO'
    };

    return $message;
}

function filterLogs(array $logs, string $method = 'ALL', int $minMs = 0) : array {
    $result = [];

    foreach ($logs as $log) {
        $methodMatches = (
            $method === 'ALL' ||
            $log['method'] === $method
        );

        $timeMatches = $log['ms'] >= $minMs;

        if ($methodMatches && $timeMatches) {
            $result[] = $log;
        }
    }

    return $result;
}

?>