<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Sign Up</h3>

    <form action="includes/formhandler.php" method="post">
        <input type="text" name="username" placeholder="Username"> <br><br>
        <input type="password" name="pwd" placeholder="Password"> <br><br>
        <input type="text" name="email" placeholder="E-Mail"> <br><br>
        <button>Sign Up</button>
    </form>

    <h3>Change account</h3>
    <form action="includes/userupdate.php" method="post">
        <input type="text" name="username" placeholder="Username"> <br><br>
        <input type="password" name="pwd" placeholder="Password"> <br><br>
        <input type="text" name="email" placeholder="E-Mail"> <br><br>
        <button>Update</button>
    </form>

    <h3>Delete account</h3>
    <form action="includes/userdelete.php" method="post">
        <input type="text" name="username" placeholder="Username"> <br><br>
        <input type="password" name="pwd" placeholder="Password"> <br><br>
        <button>Delete</button>
    </form>
</body>
</html>