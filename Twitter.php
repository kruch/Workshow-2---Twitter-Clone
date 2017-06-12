<?php
require_once 'header.php';
require_once './Model/Tweet.php';
require_once 'DB_connection.php';
require_once './Model/Comment.php';

//var_dump($_SESSION);
############# tworzymy obiekt tweet
if(isset($_POST['text'])){
    $t=new Tweet();
    $t->setUserId($_SESSION['id']);
    $t->setText($_POST['text']);
    $t->setMsg_date(date('Y-m-d H:i:s'));
    $t->saveToDB($conn);
}


$loadTweets=Tweet::loadAllTweets($conn);
$loadedTweets=array_reverse($loadTweets);

//var_dump($loadedTweets);

if(isset($_POST['comment'])&&isset($_POST['tweetid'])){
    $c=new Comment();
    $c->setUserId($_SESSION['id']);
    $c->setText($_POST['comment']);
    $c->setMsg_date(date('Y-m-d H:i:s'));
    $c->setTweetId($_POST['tweetid']);
    $c->saveToDB($conn);
}



?>


<!DOCTYPE html>
<html>
    <head>
        <style>

        </style>
    </head>
    <body>

        <h1 class="centerText">Welcome to the main page</h1>


        <form method="post" action="Twitter.php" class="centerElements" >
            <input name="text" type="text" width="50">
            <button type="submit">Tweet</button>
        </form>


        <table style="width:40%"  class="centerElements">
            <tr>
                <th>who</th>
                <th>message</th>
                <th>date</th>
            </tr>
            <?php
            foreach($loadedTweets as $tweet){
            echo '<tr><td>'.$tweet->showUsername($conn).'</td>
                <td>'.$tweet->getText().'</td>
                <td>'.$tweet->getMsg_date().'</td>
            </tr>';
            echo '<tr><td colspan="3"><form method="post" action="Twitter.php" class="centerElements" >
                <input name="comment" type="text" width="50">
                <input name="tweetid" type="hidden" value="'.$tweet->getId().'">
                <button type="submit">Comment</button>
            </form></td></tr>';
            $loadComments=Comment::loadCommentsByTweetId($conn,$tweet->getId());
            $loadedComments=array_reverse($loadComments);
            echo '<div>';
            foreach($loadedComments as $comment){
                echo '<td>'.$comment->showUsername($conn).'</td>
                    <td>'.$comment->getText().'</td>
                    <td>'.$comment->getMsg_date().'</td>
                </tr>';

            }echo '</div>';





}
?>

        </table>
    </div>
