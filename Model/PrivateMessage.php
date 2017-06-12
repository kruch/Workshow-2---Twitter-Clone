<?php

require_once 'User.php';

class Message
{
    private $id;
    private $author_Id;
    private $receiver_id;
    private $text;
    private $status;
    private $msg_date;
    //protected $username;



        public function __construct()
    {
        $this->id = -1;
        $this->author_Id = 0;
        $this->receiver_id = 0;
        $this->status="unread";
        $this->text = '';
        $this->msg_date = '';
    }


    public static function loadAllMessagesByAuthor(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM Messages WHERE author_id=$id";
        $ret = array();
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->author_Id = $row['author_id'];
                $loadedMessage->receiver_id = $row['receiver_id'];
                $loadedMessage->status = $row['status'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->msg_date = $row['creationDate'];
                $ret[]=$loadedMessage;
            }
        }
        return $ret;
    }

    public static function loadAllMessagesByReceiver(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM Messages WHERE receiver_id=$id";
        $ret = array();
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->author_Id = $row['author_id'];
                $loadedMessage->receiver_id = $row['receiver_id'];
                $loadedMessage->status = $row['status'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->msg_date = $row['creationDate'];
                $ret[]=$loadedMessage;
            }
        }
        return $ret;
    }


    public function saveToDB($connection)
    {
        if ($this->id == -1) {
            $sql = "INSERT INTO Messages(author_id, receiver_id, creationDate, text, status) "
                    . "VALUES ('$this->author_Id', '$this->receiver_id', '$this->msg_date', '$this->text', '$this->status')";

            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;

                return true;
            } else {
                return false;
            }
        }
    }

    public function showAuthorName($connection)
    {
        $sql="SELECT username FROM Users WHERE id='$this->author_Id'";
        $result=$connection->query($sql);
        $username="";
        if ($result==true&&$result->num_rows!=0) {
            $loadedUser=$result->fetch_assoc();
            $username=$loadedUser['username'];
        }
        return $username;
    }

        public function showReceiverName($connection)
    {
        $sql="SELECT username FROM Users WHERE id='$this->receiver_id'";
        $result=$connection->query($sql);
        $username="";
        if ($result==true&&$result->num_rows!=0) {
            $loadedUser=$result->fetch_assoc();
            $username=$loadedUser['username'];
        }
        return $username;
    }
    function getId() {
        return $this->id;
    }

    function getAuthor_Id() {
        return $this->author_Id;
    }

    function getReceiver_id() {
        return $this->receiver_id;
    }

    function getText() {
        return $this->text;
    }

    function getStatus() {
        return $this->status;
    }

    function getMsg_date() {
        return $this->msg_date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAuthor_Id($author_Id) {
        $this->author_Id = $author_Id;
    }

    function setReceiver_id($receiver_id) {
        $this->receiver_id = $receiver_id;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setMsg_date($msg_date) {
        $this->msg_date = $msg_date;
    }


}
