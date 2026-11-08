<?php
declare(strict_types=1);

function calculateCourseCost(
    int $credits,
    float $labFee,
    float $creditRate = 120.00
): float {

    return ($credits * $creditRate) + $labFee;
}

function getDepartmentLabel(string $deptCode): string {
    return match($deptCode) {
        "CS" => 'Computer Science',
        "IT" => 'Information Technology',
        "Design" => "Digital Design",
        default => "General Studies"
    };
}

?>