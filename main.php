<?php
require_once 'header.php';
require_once 'config.php';
require_once 'DB_connection.php';
require_once './Model/User.php';
require_once './Model/Tweet.php';
//require_once './Model/Comment.php';


### sprawdzamy jakie id wchodzi na strone


if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $u=User::loadUserByEmail($_POST['email'], $conn);
    if ($u===null) {
        echo "user unknown";
        echo '<a href="index.php"><button>try again</button></a>';
    } elseif (password_verify($_POST['password'], $u->getHashed_password())) {
        $_SESSION['id']=$u->getId();
        $_SESSION['email']=$u->getEmail();
        $_SESSION['username']=$u->getUsername();

        require_once 'Twitter.php';
    } else {
        echo "incorrect password<br>";
        echo '<a href="index.php"><button>try again</button></a>';
    }
}
if($_SESSION['id']){
    require_once 'Twitter.php';
}
