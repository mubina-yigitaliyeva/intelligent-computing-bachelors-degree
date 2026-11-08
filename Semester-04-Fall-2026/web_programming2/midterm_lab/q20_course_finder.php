<?php
declare(strict_types=1);

require_once __DIR__ . '/q20_functions.php';

$courses = [
    [
        'course_code' => 'CS101',
        'title' => 'Introduction to Programming',
        'department' => 'CS',
        'credits' => 4,
        'lab_fee' => 50.00,
        'is_online' => 0
    ],
    [
        'course_code' => 'CS202',
        'title' => 'Web Development',
        'department' => 'CS',
        'credits' => 4,
        'lab_fee' => 75.00,
        'is_online' => 1
    ],
    [
        'course_code' => 'CS303',
        'title' => 'Database Systems',
        'department' => 'CS',
        'credits' => 3,
        'lab_fee' => 60.00,
        'is_online' => 0
    ],
    [
        'course_code' => 'CS404',
        'title' => 'Software Engineering',
        'department' => 'CS',
        'credits' => 4,
        'lab_fee' => 90.00,
        'is_online' => 1
    ],
    [
        'course_code' => 'IT101',
        'title' => 'Network Fundamentals',
        'department' => 'IT',
        'credits' => 3,
        'lab_fee' => 40.00,
        'is_online' => 0
    ],
    [
        'course_code' => 'IT202',
        'title' => 'Cloud Computing',
        'department' => 'IT',
        'credits' => 3,
        'lab_fee' => 70.00,
        'is_online' => 1
    ],
    [
        'course_code' => 'DES101',
        'title' => 'Graphic Design Basics',
        'department' => 'Design',
        'credits' => 3,
        'lab_fee' => 80.00,
        'is_online' => 0
    ],
    [
        'course_code' => 'DES202',
        'title' => 'User Interface Design',
        'department' => 'Design',
        'credits' => 3,
        'lab_fee' => 100.00,
        'is_online' => 1
    ]
];

// Allowed department values
$allowedDepartments = ['ALL', 'CS', 'IT', 'Design'];

// Read GET inputs
$dept = $_GET['dept'] ?? 'ALL';
$keywordInput = $_GET['keyword'] ?? '';
$onlyOnline = isset($_GET['only_online']);

$errors = [];

// Validate department
if (!in_array($dept, $allowedDepartments, true)) {
    $errors['dept'] = 'Invalid department. Using ALL.';
    $dept = 'ALL';
}

// Validate keyword
if (!is_string($keywordInput)) {
    $errors['keyword'] = 'Invalid keyword. Using empty search.';
    $keyword = '';
} else {
    $keyword = trim($keywordInput);

    if (mb_strlen($keyword) > 40) {
        $errors['keyword'] = 'Keyword must not exceed 40 characters.';
        $keyword = '';
    }
}

// Filter courses
$filteredCourses = [];

foreach ($courses as $course) {

    // Condition 1: Department
    $departmentMatches = (
        $dept === 'ALL' ||
        $course['department'] === $dept
    );

    // Condition 2: Keyword
    $keywordMatches = (
        $keyword === '' ||
        stripos($course['title'], $keyword) !== false
    );

    // Condition 3: Online
    $onlineMatches = (
        !$onlyOnline ||
        $course['is_online'] == 1
    );

    if (
        $departmentMatches &&
        $keywordMatches &&
        $onlineMatches
    ) {
        $filteredCourses[] = $course;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>University Course Finder</title>
</head>
<body>

    <h2>University Course Finder</h2>

    <form method="GET">

        <label for="dept">Department:</label>

        <select name="dept" id="dept">

            <?php foreach ($allowedDepartments as $option) { ?>

                <option
                    value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"
                    <?= $dept === $option ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        <label for="keyword">Keyword:</label>

        <input
            type="text"
            name="keyword"
            id="keyword"
            value="<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <label>
            <input
                type="checkbox"
                name="only_online"
                value="1"
                <?= $onlyOnline ? 'checked' : '' ?>
            >
            Only Online Courses
        </label>

        <br><br>

        <button type="submit">Search Courses</button>

    </form>

    <?php foreach ($errors as $error) { ?>

        <p>
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>

    <?php } ?>

    <h3>Search Results</h3>

    <p>
        Matching Courses: <?= count($filteredCourses) ?>
    </p>

    <table border="1" cellpadding="8">

        <tr>
            <th>Code</th>
            <th>Title</th>
            <th>Department</th>
            <th>Credits</th>
            <th>Lab Fee</th>
            <th>Format</th>
            <th>Estimated Tuition</th>
        </tr>

        <?php foreach ($filteredCourses as $course) { ?>

            <?php
                $tuition = calculateCourseCost(
                    credits: $course['credits'],
                    labFee: $course['lab_fee']
                );

                $format = $course['is_online']
                    ? 'Online'
                    : 'In-Person';
            ?>

            <tr>
                <td>
                    <?= htmlspecialchars($course['course_code'], ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars($course['title'], ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        getDepartmentLabel($course['department']),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </td>

                <td>
                    <?= $course['credits'] ?>
                </td>

                <td>
                    $<?= number_format($course['lab_fee'], 2) ?>
                </td>

                <td>
                    <?= htmlspecialchars($format, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <td>
                    $<?= number_format($tuition, 2) ?>
                </td>
            </tr>

        <?php } ?>

    </table>

    <?php if (count($filteredCourses) === 0) { ?>
        <p>No matching courses found.</p>
    <?php } ?>

</body>
</html>