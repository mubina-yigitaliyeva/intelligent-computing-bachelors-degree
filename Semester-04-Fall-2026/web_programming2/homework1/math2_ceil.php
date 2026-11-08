<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function round_number_up() 
{
    $number = 4.3;
    echo "<div style='margin-left:20px;margin-top:20px'>$number rounded up is " . ceil($number) . "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Round a number up</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Round a number up</h1>
    </header>
    <article>
        <?php round_number_up() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>
