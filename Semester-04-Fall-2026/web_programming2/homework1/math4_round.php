<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function round_number() 
{
    $number = 7.6;
    echo "<div style='margin-left:20px;margin-top:20px'>$number rounded to the nearest integer is " . round($number) . "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Round a number</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Round a number</h1>
    </header>
    <article>
        <?php round_number() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>
