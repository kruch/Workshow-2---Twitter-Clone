<?php
require_once 'header.php';
require_once 'config.php';
require_once 'DB_connection.php';
require_once './Model/User.php';
require_once './Model/PrivateMessage.php';

var_dump($_SESSION);
var_dump($_POST);

if(isset($_POST['receiver'])&&isset($_POST['text'])){
$m=new Message();
$m->setAuthor_Id($_SESSION['id']);
$m->setReceiver_id($_POST['receiver']);
$m->setText($_POST['text']);
$m->setMsg_date(date('Y-m-d H:i:s'));
$m->savetoDB($conn);
var_dump($m);
}

$u=User::loadAllUsers($conn);


?>

<form method="post" action="" class="centerElements" >
    Receiver:
    <input name="receiver" type="text" width="50"><br>
    Message:
    <input name="text" type="text" width="50">
    <button type="submit">Message</button>
</form>

<?php
$allMsgByAuthor=Message::loadAllMessagesByAuthor($conn, $_SESSION['id']);

$allMsgByReceiver=Message::loadAllMessagesByReceiver($conn, $_SESSION['id']);

?>
<table style="width:40%"  class="centerElements">
    <tr>
        <th>to</th>
        <th>message</th>
        <th>date</th>
        <th>status</th>
    </tr>

    <?php

    echo "Outbox<br>";
if(count($allMsgByAuthor)>0){
    foreach($allMsgByAuthor as $msg){

    echo
    '<tr><td>'.$msg->showReceiverName($conn).'</td>
        <td>'.$msg->getText().'</td>
        <td>'.$msg->getMsg_date().'</td>
        <td>'.$msg->getStatus().'</td>


    </tr>';
}
}else echo "no messages";


?>

<hr>
<table style="width:40%"  class="centerElements">
    <tr>
        <th>from</th>
        <th>message</th>
        <th>date</th>
        <th>status</th>
    </tr>

    <?php

    echo "Inbox<br>";
if(count($allMsgByReceiver)>0){
    foreach($allMsgByReceiver as $msg){
        $msg->setStatus('read');
    echo
    '<tr><td>'.$msg->showAuthorName($conn).'</td>
        <td>'.$msg->getText().'</td>
        <td>'.$msg->getMsg_date().'</td>
        <td>'.$msg->getStatus().'</td>


    </tr>';
}
}else echo "no messages";


?>
