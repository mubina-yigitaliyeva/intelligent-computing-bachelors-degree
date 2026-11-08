<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function convert_string() 
{
    $iso8859_1_string = "\x5A\x6F\xEB";
    $utf8_string = utf8_encode($iso8859_1_string);

    echo '<p><b>ISO-8859-1 string: </b> ' . $iso8859_1_string . '</p>';
    echo '<p><b>converted to UTF-8:</b> ' . bin2hex($utf8_string) . '</p>';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Converts a string from ISO-8859-1 to UTF-8</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Converts a string from ISO-8859-1 to UTF-8</h1>
    </header>
    <article>
        <?php convert_string() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>