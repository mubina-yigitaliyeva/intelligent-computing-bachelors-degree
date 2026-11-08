<?php 

function write_studentname_id() 
{
    $name = 'Yigitalieva Mubina';
    $id = 20253721;
    echo $name . ' ' . $id;
}

function convert_string_to_array() 
{
    if (isset($_POST['text'])) {
        $str = $_POST['text'];

        $arr = str_split($str);

        echo "<h3>Each character:</h3>";
        print_r($arr);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>String Built-in Functions</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header> 
        <h1>Convert a string to an array</h1>
    </header>
    <article>
        <form method="post">
            <input type="text" name="text">
            <button type="submit">convert</button>
        </form>

        <?php convert_string_to_array() ?>
    </article>
    <footer>
        <?php write_studentname_id() ?>
    </footer>
</body>
</html>