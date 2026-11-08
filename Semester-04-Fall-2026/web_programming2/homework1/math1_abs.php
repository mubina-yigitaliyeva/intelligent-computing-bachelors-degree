<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function find_absolute_value() 
{
    $number = -25;
    echo "<div style='margin-left:20px;margin-top:20px'>Absolute value of $number is " . abs($number) . "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Find absolute value</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Find absolute value</h1>
    </header>
    <article>
        <?php find_absolute_value() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>
