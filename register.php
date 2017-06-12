<?php

require_once 'DB_connection.php';
require_once './Model/User.php';
echo "register";
session_start();
//var_dump($_POST);

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (isset($_POST['email']) && isset($_POST['username'])&& isset($_POST['password'])) {
        $u=new User();
        $u->setEmail($_POST['email']);
        $u->setUsername($_POST['username']);
        $hashed_password= password_hash($_POST['password'], PASSWORD_BCRYPT);
        $u->setHashed_password($hashed_password);

        $u->savetoDB($conn);

        echo "uzytkownik zarejestrowany";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>

</head>
<body>

    <h2 class="c">New to Twitter-Clone?<br> Please register down below:</h2>
    <form action="" method="post" class="c">
        E-mail: <input type="text" name="email"><br>
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <button type="Submit" value="Submit">Register</button>
    </form>
<a href="index.php"><button>Go to login</button></a>

</form>

</body>
</html>
<?php
