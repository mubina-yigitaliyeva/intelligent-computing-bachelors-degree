
<?php

function e($value): string
{
    return htmlspecialchars(
        (string) ($value ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
}

function redirect(string $page): void
{
    header("Location: $page");
    exit();
}

function requireLogin(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['admin_id'])) {
        redirect('login.php');
    }
}

function validateEntry(array $data): array
{
    $errors = [];

    $allowedTypes = [
        'education',
        'experience',
        'project'
    ];

    if (!in_array(
        $data['entry_type'] ?? '',
        $allowedTypes,
        true
    )) {
        $errors[] = 'Please select a valid entry type.';
    }

    if (trim($data['title'] ?? '') === '') {
        $errors[] = 'Title is required.';
    }

    if (trim($data['organization'] ?? '') === '') {
        $errors[] = 'Organization is required.';
    }

    $startDate = $data['start_date'] ?? '';

    if (!validDate($startDate)) {
        $errors[] = 'Please enter a valid start date.';
    }

    $endDate = $data['end_date'] ?? '';

    if ($endDate !== '' && !validDate($endDate)) {
        $errors[] = 'Please enter a valid end date.';
    }

    if (
        validDate($startDate) &&
        $endDate !== '' &&
        validDate($endDate) &&
        $endDate < $startDate
    ) {
        $errors[] = 'End date cannot be before start date.';
    }

    if (trim($data['description'] ?? '') === '') {
        $errors[] = 'Description is required.';
    }

    return $errors;
}

// date format: YYYY-MM-DD
function validDate(string $date): bool
{
    $d = DateTime::createFromFormat('!Y-m-d', $date);

    return $d !== false
        && $d->format('Y-m-d') === $date;
}

function displayDate(?string $date): string
{
    if (empty($date)) {
        return 'Present';
    }

    return date('M Y', strtotime($date));
}


function processAvatar(array $file): string
{
    if (
        !isset($file['error']) ||
        $file['error'] !== UPLOAD_ERR_OK
    ) {
        throw new RuntimeException('Image upload failed.');
    }

    if (
        empty($file['tmp_name']) ||
        !is_uploaded_file($file['tmp_name'])
    ) {
        throw new RuntimeException('Invalid uploaded file.');
    }

    // max file size = 2 MB
    $maxSize = 2 * 1024 * 1024;

    if (
        $file['size'] <= 0 ||
        $file['size'] > $maxSize
    ) {
        throw new RuntimeException(
            'Image must not exceed 2 MB.'
        );
    }

    $type = mime_content_type($file['tmp_name']);

    $ext = strtolower(
        pathinfo($file['name'], PATHINFO_EXTENSION)
    );

    $allowedTypes = [
        'image/jpeg',
        'image/png'
    ];

    $allowedExts = [
        'jpg',
        'jpeg',
        'png'
    ];

    if (
        !in_array($type, $allowedTypes, true) ||
        !in_array($ext, $allowedExts, true)
    ) {
        throw new RuntimeException(
            'Only JPEG and PNG images are allowed.'
        );
    }

    $imageInfo = getimagesize($file['tmp_name']);

    if ($imageInfo === false) {
        throw new RuntimeException('Invalid image.');
    }

    [$width, $height] = $imageInfo;

    if ($width <= 0 || $height <= 0) {
        throw new RuntimeException(
            'Invalid image dimensions.'
        );
    }

    // openning image using GD
    if ($type === 'image/jpeg') {
        $source = imagecreatefromjpeg($file['tmp_name']);
    } else {
        $source = imagecreatefrompng($file['tmp_name']);
    }

    if ($source === false) {
        throw new RuntimeException(
            'Unable to process the image.'
        );
    }

    // a 150 x 150 thumbnail
    $size = 150;

    $thumbnail = imagecreatetruecolor($size, $size);

    if ($thumbnail === false) {
        imagedestroy($source);
        throw new RuntimeException(
            'Could not create thumbnail.'
        );
    }

    $white = imagecolorallocate(
        $thumbnail,
        255,
        255,
        255
    );

    imagefill($thumbnail, 0, 0, $white);

    $cropSize = min($width, $height);

    $sourceX = (int) (($width - $cropSize) / 2);
    $sourceY = (int) (($height - $cropSize) / 2);

    // cropping and resizing using GD
    $resized = imagecopyresampled(
        $thumbnail,
        $source,
        0,
        0,
        $sourceX,
        $sourceY,
        $size,
        $size,
        $cropSize,
        $cropSize
    );

    if (!$resized) {
        imagedestroy($source);
        imagedestroy($thumbnail);

        throw new RuntimeException(
            'Could not resize the image.'
        );
    }

    $filename = bin2hex(random_bytes(16)) . '.jpg';

    $uploadDirectory = __DIR__ . '/../uploads/';

    if (!is_dir($uploadDirectory)) {
        imagedestroy($source);
        imagedestroy($thumbnail);

        throw new RuntimeException(
            'Upload directory does not exist.'
        );
    }

    $destination = $uploadDirectory . $filename;

    $saved = imagejpeg(
        $thumbnail,
        $destination,
        90
    );

    imagedestroy($source);
    imagedestroy($thumbnail);

    if (!$saved) {
        throw new RuntimeException(
            'Could not save the thumbnail.'
        );
    }

    return $filename;
}
