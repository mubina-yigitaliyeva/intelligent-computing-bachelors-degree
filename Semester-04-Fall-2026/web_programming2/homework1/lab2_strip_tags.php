<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function strip_html_php_tags_from_string() 
{
    $text = '<p>This is homework.</p><!-- Comment --> <a href="#topic">5 built-in string functions</a>';
    
    echo '<p><b>This is example text:</b> ' . htmlspecialchars($text) . '</p>';
    echo '<p><b>Result:</b> ' . strip_tags($text) . '</p>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Strip HTML and PHP tags from a string</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Strip HTML and PHP tags from a string</h1>
    </header>
    <article>
        <?php strip_html_php_tags_from_string() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>