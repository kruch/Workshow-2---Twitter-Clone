<?php



require_once 'config.php';
$conn = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($conn->connect_error){
        echo("Connect failed: ". mysqli_connect_error());
        exit();
    }
    if($conn==true){
        echo "Twitter connected<br>";
    }
    ?>
