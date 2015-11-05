<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>东西街注册</title>
	<link rel="stylesheet" type="text/css" href="../css/mag.css"/>
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/message.js"></script>
	<script type="text/javascript" src="../js/ajax.js"></script>
</head>
<?php
 require("dbconfig.php");

$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();

$query = mysql_query("select id,token_exptime from user where status='0' and token='$verify'")or die("选择失败".mysql_error());
$row=mysql_fetch_assoc($query);
if($row){
	if($nowtime>$row['token_exptime']){ //30min
		$msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
	}else{
		$a=mysql_query("update user set status=1 where id=".$row['id']);
		var_dump($a);
		if(mysql_affected_rows($link)!=1) die(0);/**/
		$msg = '激活成功！';
	}
}else{
	$msg = "error";	
}
?>
<body>
    <div class="wrap">
    	<div class="header">
			<ul>
				<li class="news"><a href="###">消息</a></li>
				<li><a href="../page/register.php">注册</a></li>
				<li><a href="../page/login.php">登录</a></li>
			</ul>
		</div>
		<div class="logo">
			<img src="../images/tit.gif"/>
		</div>
		<div class="register-wrap">
	        <div class="register-teb">
	            <div class="teb-mod">邮箱注册</div>
	            <p class="link0">已有帐号，<a href="../page/login.php">直接登录&gt;&gt;</a></p>
	        </div>
	        <div class="register-hd">
	            <!--=S 注册步骤-->
                <span class="underway">1、填写信息</span>
                <span class="stay2 underway">2、激活账号</span>
                <span class="stay3 underway">3、注册完成</span>
	            <!--=E 注册步骤 -->
	        </div>
	        <div class="register-bd" id="registerEmail">
	            
	        </div>
	        <div class="activate">
	        	
	        </div>
	        <div class="finished">
	        	<p><?php echo $msg; ?>您已完成激活，现在<a href="../page/login.php">登录</a></p>
	        	<!-- <div class="line">
				    <div class="label"></div>
				    <div class="registernow registered" id="after">完成</div>
				</div> -->
	        </div>
		</div>
		<div class="footer">&copy;copyright版权所有</div>
	</div>

	<script type="text/javascript">
         $(function(){

         	$(".protocol").click(function(){
         		$(".register-protocol").show();
         	})
         	$(".protocol-x").click(function(){
         		$(".register-protocol").hide();
         	})	
         	$(".activate").hide();
            $(".register-bd").hide();
            $(".finished").show();
            


         })
	</script>
</body>
</html>
