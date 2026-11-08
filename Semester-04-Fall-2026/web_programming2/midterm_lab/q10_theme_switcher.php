<?php
$allowedThemes = ['light', 'dark', 'sepia'];
$allowedSizes = ['small', 'medium', 'large'];


$theme = $_GET['theme'] ?? 'light';
$size = $_GET['size'] ?? 'medium';

$warnings = [];

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
    $warnings[] = 'Theme does not exist';
}

if (!in_array($size, $allowedSizes, true)) {
    $size = 'medium';
    $warnings[] = 'Size does not exist';
}

echo "Size: " . htmlspecialchars($size) . "<br>";
echo "Theme: " . htmlspecialchars($theme) . "<br>";

echo "<br>";

foreach ($warnings as $w) {
    echo htmlspecialchars($w) . "<br>";
}

?>