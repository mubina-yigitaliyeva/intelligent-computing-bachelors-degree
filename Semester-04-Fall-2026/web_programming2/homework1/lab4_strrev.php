<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function reverse_string() 
{
    if (isset($_POST['text'])) {
        echo "<div style='margin-left:20px;margin-top:20px'>Reversed string: " . strrev($_POST['text']) . '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reverse a string</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Reverse a string</h1>
    </header>
    <article>
        <form method="post">
            <input type="text" name="text">
            <button type="submit">reverse</button>
        </form>

        <?php reverse_string() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>