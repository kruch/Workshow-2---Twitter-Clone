<?php

require_once 'User.php';

class Tweet
{
    protected $id;
    protected $userId;
    protected $text;
    protected $msg_date;
    //protected $username;


    public function __construct()
    {
        $this->id = -1;
        $this->userId = 0;
        $this->text = '';
        $this->msg_date = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getMsg_date()
    {
        return $this->msg_date;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($connection)
    {
        return $this->username;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setMsg_date($msg_date)
    {
        $this->msg_date = $msg_date;
    }

    public static function loadAllTweets(mysqli $connection)
    {
        $sql = "SELECT * FROM Tweets";
        $ret = array();
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['user_id'];
                $loadedTweet->text = $row['message'];
                $loadedTweet->msg_date = $row['msg_date'];
                $ret[]=$loadedTweet;
            }
        }
        return $ret;
    }

    public function saveToDB($connection)
    {
        if ($this->id == -1) {
            $sql = "INSERT INTO Tweets(user_id, message, msg_date) "
                    . "VALUES ('$this->userId', '$this->text', '$this->msg_date')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {
                return false;
            }
        } else {
            $sql = "UPDATE Tweets SET user_id='$this->userId',"
                    . "message='$this->text',"
                    . "msg_date='$this->msg_date'"
                    . "WHERE id='$this->id'";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
    }

    public function showUsername($connection)
    {
        $sql="SELECT username FROM Users WHERE id='$this->userId'";
        $result=$connection->query($sql);
        $username="";
        if ($result==true&&$result->num_rows!=0) {
            $loadedUser=$result->fetch_assoc();
            $username=$loadedUser['username'];
        }
        return $username;
    }
}
?>
