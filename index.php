<?php
require_once 'config.php';
require_once 'DB_connection.php';
//require_once 'header.php';
require_once './Model/User.php';



session_start();

if(!empty($_POST['logout'])){
    session_unset();
    var_dump($_SESSION);
}
?>

<!DOCTYPE html>
<html>
    <head>
    <h2 class="c">Please login</h2>
</head>
<body>
    <form action="main.php" method="post" class="c">
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="password"><br>
        <button type="Submit" value="Submit">Login</button>
    </form> <br><br>
    <h2 class="c">New to Twitter-Clone?<br> Please register down below:</h2>
    <form action="register.php" method="post" class="c">

        <a href="register.php">
        <button>Register</button>
        </a>

    </form>

    <form action="register.php" method="post"></form>
</body>
</html>
