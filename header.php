<?php
session_start();

?>

<html>
    <head>
        <title>Twitter Clone</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="theme.css">

    </head>
    <body>
        <div class="">
            Logged user: <?php
            //var_dump($_SESSION);
            if (isset($_SESSION['username'])) {
                echo $_SESSION['username'];
            } else {
                echo " not logged";
            }

             ?>

            <form name="logout" action='index.php' metod="post">
            <button type="submit">Log Out</button><br><br>
            </form>
            <form name="inbox" action='Private_msg.php' metod="post">
            <button type="submit">Inbox</button>
        </form>

        </div>
