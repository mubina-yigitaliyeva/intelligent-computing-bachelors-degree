<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function round_number_down() 
{
    $number = 8.9;
    echo "<div style='margin-left:20px;margin-top:20px'>$number rounded down is " . floor($number) . "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Round a number down</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Round a number down</h1>
    </header>
    <article>
        <?php round_number_down() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>
