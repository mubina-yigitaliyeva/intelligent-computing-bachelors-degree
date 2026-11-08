<?php
$statusCodes = [200, 201, 301, 400, 404, 500, '200', 999];

foreach ($statusCodes as $code) {
    $description = match($code) {
        200, 201 => "Success: Request completed",
        301, 302 => "Redirect: Resource moved",
        400, 401, 403 => "Client Error: Bad request or unauthorized",
        404 => "Client Error: Not Found",
        500, 503 => "Server Error: Internal failure",
        default => "Unknown or non-integer status code"
    };

    echo $code . " | " . gettype($code) . " | " . $description . "\n";
}

?>