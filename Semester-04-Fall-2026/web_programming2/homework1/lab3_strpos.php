<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function find_substring() 
{
    $mystring = 'Hello PHP';
    $target   = 'l';
    $pos = strpos($mystring, $target);

    if ($pos === false) {
        echo "<div style='margin-left:20px;'>
                The string '$target' was not found in the string '$mystring'
            </div>";
    } else {
        echo "<div style='margin-left:20px;'>
                The string '$target' was found in the string '$mystring' and exists at position $pos
            </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Find the position of the first occurrence of a substring in a string</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Find the position of the first occurrence of a substring in a string</h1>
    </header>
    <article>
        <?php find_substring() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>