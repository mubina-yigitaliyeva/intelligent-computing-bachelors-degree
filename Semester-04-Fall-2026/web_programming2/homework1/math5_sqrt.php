<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function find_square_root() 
{
    $number = 81;
    echo "<div style='margin-left:20px;margin-top:20px'>Square root of $number is " . sqrt($number) . "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Find square root</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Find square root</h1>
    </header>
    <article>
        <?php find_square_root() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>
