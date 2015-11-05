<?php
    require("dbconfig.php");
    $comment_id = trim($_GET['commentId']);
    $reply_pass_time = date('y-m-d',time());

    $update = mysql_query("update comment set feedback = 0,reply_pass_time = '$reply_pass_time' where comment_id = '$comment_id'")or die(mysql_error());
    if($update) {
        echo "评论已通过!";
    }
?>