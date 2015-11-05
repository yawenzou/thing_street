<?php
    require("dbconfig.php");
    $mail=$_POST['mail'];
    $nicknames=trim($_POST['nicknames']);
    $password=trim($_POST['password']);
   // $mail="1161486206@qq.com";
    //$nicknames="zzz";
    //$password="123456";

    $username = stripslashes($nicknames);
    $password = md5($password);
    $email = $mail;

    $regtime = time();

    $token = md5($username.$password.$regtime); //创建用于激活识别码
    $token_exptime = time()+60*60*24;//过期时间为24小时后

    $sql = "insert into user (nicknames,password,mail,token,token_exptime,regtime) values ('$username','$password','$email','$token','$token_exptime','$regtime')";

    $a=mysql_query($sql);
if(mysql_insert_id()){//写入成功，发邮件
	include_once("smtp.class.php");
	$smtpserver = "smtp.139.com"; //SMTP服务器
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = "dxj_zyw@139.com"; //SMTP服务器的用户邮箱
    $smtpuser = "dxj_zyw"; //SMTP服务器的用户帐号
    $smtppass = "zyw1161486206"; //SMTP服务器的用户密码
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
    $smtpemailto = $email;
    $smtpemailfrom = $smtpusermail;
    $emailsubject = "用户帐号激活";
    $emailbody = "亲爱的".$username."：<br/>感谢您在我站东西街注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://localhost/myfile/dxj-ajax/deal/active.php?verify=".$token."'>active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- 东西街</p>";
    $smtp->debug = true;
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);

	if($rs==1){
		$msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';	
	}else{
		$msg = $rs;	
	}
echo $msg;
//var_dump($msg);
}
?>