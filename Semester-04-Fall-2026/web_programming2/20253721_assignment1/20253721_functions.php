
<?php
/*
Student ID: 20253721
Name: Mubina Yigitalieva
Date: 2026.10.11

PHP manuals consulted:
https://www.php.net/manual/en/function.str-word-count.php
https://www.php.net/manual/en/function.filter-var.php
https://www.php.net/manual/en/function.array-map.php
*/

header('Content-Type: text/plain; charset=UTF-8');

// Activity 1. String Processing ****************************************************
$blog_title = " learning PHP FUNCTIONS is fun! ";
$blog_title = trim($blog_title);
$blog_title = ucwords(strtolower($blog_title));
$blog_title = str_replace('Php', 'PHP', $blog_title);
$blog_title = str_replace('!', '', $blog_title);

echo "Activity 1. String Processing\n";
echo "Final title: " . $blog_title . "\n";
echo "Total characters: " . strlen($blog_title) . "\n\n";

// Activity 2. Rating Calculation ***************************************************
$number = random_int(1, 100);
$square_root = sqrt($number);
$rounded = ($number % 2 == 0)
    ? floor($square_root)
    : ceil($square_root);

echo "Activity 2. Rating Calculation\n";
echo "Number $number | Sqrt: "
    . round($square_root, 4)
    . " | Rounded: $rounded\n\n";

// Activity 3. Languages Array ******************************************************
$languages = ['PHP', 'JavaScript', 'Python', 'PHP'];
$languages = array_unique($languages);
$languages = array_map('trim', $languages);
$languages[] = 'Go';
$languages[] = 'Java';

sort($languages);

echo "Activity 3. Languages Array\n";
echo "Total languages: " . count($languages) . "\n";
echo "Final list: " . implode(', ', $languages) . "\n\n";

// Activity 4. Custom Function Reading Time ******************************************
function calculateReadingTime($text, $speed = 200) {
    if (trim($text) === '') {
        return 0;
    }

    $words = str_word_count($text);
    return ceil($words / $speed);
}

$text = "One morning, when Gregor Samsa woke from troubled
dreams, he found himself transformed in his bed into a
horrible vermin. He lay on his armour-like back, and if
he lifted his head a little he could see his brown belly,
slightly domed and divided by arches into stiff sections.
The bedding was hardly able to cover it and seemed ready
to slide off at any moment. His many legs, pitifully thin
compared with the size of the rest of him, waved about
helplessly as he looked at his surroundings.";

echo "Activity 4. Custom Function Reading Time\n";
echo "Estimated reading time: "
    . calculateReadingTime($text)
    . " minute(s).\n\n";

// Activity 5. Form Handling and Validation *******************************************
$test_input = [
    'name' => 'Ali Kim',
    'email' => 'ali.kim@example.com',
    'age' => '21',
    'message' => 'This is a test message for validation.'
];

$input = !empty($_POST) ? $_POST : $test_input;

// Read and trim input safely
$name = isset($input['name']) && is_string($input['name'])
    ? trim($input['name']) : '';

$email = isset($input['email']) && is_string($input['email'])
    ? trim($input['email']) : '';

$age = isset($input['age']) && is_string($input['age'])
    ? trim($input['age']) : '';

$message = isset($input['message']) && is_string($input['message'])
    ? trim(strip_tags($input['message'])) : '';

$errors = [];

// Validate name
if ($name === '') {
    $errors[] = 'Name is required.';
} elseif (strlen($name) > 50 ||
          !preg_match('/^[\p{L} ]+$/u', $name)) {
    $errors[] = 'Name must contain only letters and spaces (maximum 50 characters).';
}

/* preg_match() checks if the name contains only letters and spaces.
^ start, $ end, and \p{L} allows letters from all languages.
+ means one or more characters, and u supports UTF-8 characters.
*/

// Validate email
if ($email === '') {
    $errors[] = 'Email is required.';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Email is not valid.';
}

// Validate optional age
if ($age !== '' &&
    filter_var($age, FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 13,
            'max_range' => 120
        ]
    ]) === false) {
    $errors[] = 'Age must be an integer from 13 to 120.';
}

// Validate message
if ($message === '') {
    $errors[] = 'Message is required.';
} elseif (strlen($message) < 10) {
    $errors[] = 'Message must contain at least 10 characters.';
}

// Show errors or accepted submission
echo "Activity 5. Form Handling and Validation\n";

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "Error: "
            . htmlspecialchars($error, ENT_QUOTES, 'UTF-8')
            . "\n";
    }
} else {
    $valid_name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $valid_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $valid_age = $age === ''
        ? 'Not provided'
        : htmlspecialchars($age, ENT_QUOTES, 'UTF-8');

    $valid_message = htmlspecialchars(
        substr($message, 0, 50),
        ENT_QUOTES,
        'UTF-8'
    );

    $token = substr(sha1($name . time()), 0, 8);

    echo "Submission accepted: Name: $valid_name | Email: $valid_email | Age: $valid_age | Message: $valid_message...\n";
    echo "Confirmation token: $token\n";
}
?>
