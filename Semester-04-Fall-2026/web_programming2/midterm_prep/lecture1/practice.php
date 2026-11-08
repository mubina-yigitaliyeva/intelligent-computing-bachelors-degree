<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Student Profile</h1>
    <?php 
    $name = "Mubina"; 
    $university = "Dong-eui University";

    date_default_timezone_set('Asia/Seoul');
    ?>
    <p>Name is: <?php echo $name;?></p>
    <p>University is: <?php echo $university;?></p>
    <p>The time is: <?php echo date('H:i:s');?></p>

<!-- Today: Wednesday, October 21, 2026

Short date: 21/10/2026

Current time: 02:45 PM

Year: 2026 -->

    <p><?php echo date('l, F d, Y')?></p>
    <p><?php echo date('d/m/Y')?></p>
    <p><?php echo date('h:i A')?></p>
    
    <p><a href="bookstore.php">Bookstore practice</a></p>
</body>
</html>