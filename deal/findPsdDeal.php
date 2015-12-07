<?php
    require("dbconfig.php");
    $mail=$_POST['mail'];

    $randStr = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890');
    $psd = substr($randStr,0,6);
    $mdpsd = md5($psd);
    $sql = mysql_query("select * from user where mail = '$mail'")or die(mysql_error());
    $resultSelect = mysql_fetch_assoc($sql);
    $username = $resultSelect['nicknames'];
    if(!$username) {
        echo "该邮箱没有注册！";
    }
    else {
        include_once("smtp.class.php");
        $smtpserver = "smtp.139.com"; //SMTP服务器
        $smtpserverport = 25; //SMTP服务器端口
        $smtpusermail = "dxj_zyw@139.com"; //SMTP服务器的用户邮箱
        $smtpuser = "dxj_zyw"; //SMTP服务器的用户帐号
        $smtppass = "zyw1161486206"; //SMTP服务器的用户密码
        $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
        $smtpemailto = $mail;
        $smtpemailfrom = $smtpusermail;
        $emailsubject = "东西街用户找回密码";
        $emailbody = "亲爱的".$username."：<br/>您的密码是".$psd."请尽快修改密码！<br/><p style='text-align:right'>-------- 东西街</p>";
        $smtp->debug = false;
        $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);

        if($rs){
            $update = mysql_query("update user set password = '$mdpsd' where mail = '$mail'");
            if($update) {
                echo "新密码已发送到您的邮箱，请注意查收！";
            }
        }else{
            echo "邮箱有误，请重试!";
        }
    }

?>