<?php

class User {
#### Twitter clone

    private $id;
    private $username;
    private $hashed_password;
    private $email;

    static public function loadUserById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->email = $row['email'];
            $loadedUser->hashed_password = $row['hashed_password'];

            return $loadedUser;
        }return null;
    }

    public function savetoDB($connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO Users(email, username, hashed_password) "
                    . "VALUES ('$this->email', '$this->username', '$this->hashed_password')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                echo "user " . $this->username . " has been created";
                return true;
            } else {
                $sql = "SELECT * FROM Users WHERE email='$this->email'";
                $result = $connection->query($sql);
                if ($result->num_rows != 0) {
                    return true;
                }
            }
        } else {
            $sql = "UPDATE Users SET email='$this->email',"
                    . "username='$this->username',"
                    . "hashed_password='$this->hashed_password'"
                    . "WHERE id='$this->id'";
            $result = $connection->query($sql);
            if ($result == true) {
                echo "user " . $this->username . ' has been modified';
                return true;
            }
        }
    }

    static public function loadUserByEmail($email, mysqli $connection) {
        $sql = "SELECT * FROM Users WHERE email='$email'";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->email = $row['email'];
            $loadedUser->hashed_password = $row['hashed_password'];
            return $loadedUser;
        }return null;
    }

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->hashed_password = "";
        $this->email = "";
    }

    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getHashed_password() {
        return $this->hashed_password;
    }

    function setHashed_password($hashed_password) {
        $this->hashed_password = $hashed_password;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    static public function loadAllUsers(mysqli $connection){
        $sql="SELECT * from Users";
        $users=array();
        $result=$connection->query($sql);
        if($result==true&&$result->num_rows!=0){
            foreach($result as $row){
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->email = $row['email'];
                $loadedUser->hashed_password = $row['hashed_password'];
                $users[]=$loadedUser;
                
            }
        }
        return $users;
    }

}
?>
