<?php
    require("dbconfig.php");
    $num=trim($_GET['i']);
    $textareaName= 'textarea'.$num;
    $comment_content=trim($_POST[$textareaName]);
    $comment_id = trim($_GET['commentId']);
    $reply_time = date('y-m-d',time());

    $update = mysql_query("update comment set reply = '$comment_content',reply_time = '$reply_time' where comment_id = '$comment_id'")or die(mysql_error());
    if($update) {
        echo "回复成功!";
    }
?>