<?php
    require("dbconfig.php");
    $mail=trim($_POST['mail']);
    $nicknames=trim($_POST['nicknames']);
   // $mail="1161486206@qq.com";
    //$nicknames="zzz";
    //$password="123456";

    $username = stripslashes($nicknames);

    //检测用户名是否存在
    $query1 = mysql_query("select id from user where nicknames='$nicknames'")or die("选择失败".mysql_error());
    $query2 = mysql_query("select id from user where mail='$mail'")or die("选择失败".mysql_error());
    $num1 = mysql_num_rows($query1);
    $num2=mysql_num_rows($query2);
    echo "$num1".","."$num2";
?>