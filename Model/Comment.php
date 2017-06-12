<?php
require_once 'User.php';
require_once 'Tweet.php';

class Comment extends Tweet{
    private $tweetId;

    public function __construct(){
      $this->id = -1;
      $this->userId = 0;
      $this->text = '';
      $this->msg_date = '';
      $this->tweetId=0;
    }

    public static function loadCommentsByTweetId(mysqli $connection,$id)
    {
        $sql = "SELECT * FROM Comment WHERE tweet_id=$id";
        $ret = array();
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->tweet_id = $row['tweet_id'];
                $loadedComment->userId = $row['user_id'];
                $loadedComment->text = $row['message'];
                $loadedComment->msg_date = $row['msg_date'];
                $ret[]=$loadedComment;
            }
        }
        return $ret;
    }

    public function saveToDB($connection)
  {
      if ($this->id == -1) {
          $sql = "INSERT INTO Comment(tweet_id, user_id, message, msg_date) "
                  . "VALUES ($this->tweetId,
                  $this->userId,

                  '$this->text',

                  '$this->msg_date')";

          $result = $connection->query($sql);
          if ($result == true) {
              $this->id = $connection->insert_id;

              return true;
          } else {
              return false;
          }
      } else {
          $sql = "UPDATE Tweets SET "."tweet_id='$this->tweet_id',"
                    ."user_id='$this->userId',"
                  . "message='$this->text',"
                  . "msg_date='$this->msg_date'"
                  . "WHERE id='$this->id'";
          $result = $connection->query($sql);
          if ($result == true) {
              return true;
          }
      }
  }


    function getTweetId() {
        return $this->tweetId;
    }

    function setTweetId($tweetId) {
        $this->tweetId = $tweetId;
    }





}

?>
