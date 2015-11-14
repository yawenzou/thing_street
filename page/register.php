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
<body>
<?php
	session_start();
?>
    <div class="wrap">
    	<div class="header">
			<ul>
				<?php 
					if($_SESSION['islogin'] == true) {
						// echo "<li class='news'><a href='###'>消息</a></li>";
						echo "<li class='pers'><a href='changemag.php'>".$_SESSION['name']."</a></li>";
						echo "<li class='drop'><a href='../deal/delete-session.php' target='_top'>安全退出</a></li>";
					}
					else {
						echo "<li><a href='register.php'>注册</a></li>";
						echo "<li><a href='login.php'>登录</a></li>";
					}
				?>
			</ul>
		</div>
		<!-- <div class="logo">
			<a href="../search.php"><img src="../images/tit.gif"/></a>
		</div> -->
		<div class="register-title"><a href="../search.php"><img src="../images/tit.png"/></a></div>
		<div class="register-wrap">
	        <div class="register-teb">
	            <div class="teb-mod">邮箱注册</div>
	            <p class="link0">已有帐号，<a href="login.php">直接登录&gt;&gt;</a></p>
	        </div>
	        <div class="register-hd">
	            <!--=S 注册步骤-->
                <span class="underway">1、填写信息</span>
                <span class="stay2">2、激活账号</span>
                <span class="stay3">3、注册完成</span>
	            <!--=E 注册步骤 -->
	        </div>
	        <div class="register-bd" id="registerEmail">
	            <!--=S 注册信息 表单-->
	            <form id="registerForm" name="registerForm">
	                <div class="line">
						<div class="label">邮箱地址&nbsp;</div>
						<input type="text" class="register-input" id="mail" name="mail" />
					</div>
					<div class="line">
						<div class="label">昵称&nbsp;</div>
						<input type="text" class="register-input" id="nicknames" name="nicknames" />
					</div>
					<div class="line">
						<div class="label">设置密码&nbsp;</div>
						<input type="password" class="register-input" id="password" name="password" />
					</div>
					<div class="line">
						<div class="label">确认密码&nbsp;</div>
						<input type="password" class="register-input" id="againpsd" name="againpsd" />
					</div>
					<div class="line">
						<div class="label">输入验证码&nbsp;</div>
						<input type="text" class="register-input w100" id="code_char" name="againpsd" maxlength="4"/>
						<img src="../deal/code_char.php" id="getcode_char" title="看不清，点击换一张" align="absmiddle" style="margin-left:5px;height:32px">
					</div>
					<div class="line">
					    <label><div class="label"></div>
						<input type="checkbox" name="checkbox" id="checkbox"> &nbsp;我已经阅读并完全同意<a class="protocol">注册协议</a></label>
					</div>
					<div class="register-protocol">
						<div class="protocol-title">
							<span class="tit">注册协议</span>
							<span class="protocol-x">x</span>
						</div>
						<div class="protocol-content"></div>
					</div>
					<div class="line">
					    <div class="label"></div>
						<div class="registernow registered" id="register" onclick="register()">立即注册</div>
					</div>
					<div id="error" class="magl-20 magt10"></div>
					
	            </form>
	        </div>
	        <div class="activate">
	        	<p>激活链接已发送到你的邮箱，请进入邮箱点击链接激活</p>
	        	<div class="line">
					    <div class="label"></div>
					    <div class="registernow registered marr10" id="before">上一步</div>
						<div class="registernow " id="after">下一步</div>
					</div>
	        </div>
	        <div class="finished">
	        	<p>您已完成激活，现在<a href="login.php">登录</a></p>
	        	<div class="line">
				    <div class="label"></div>
				    
				</div>
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

         	//数字+字母验证
			$("#getcode_char").click(function(){
				$(this).attr("src",'../deal/code_char.php?' + Math.random());
			});

         })
	</script>
</body>
</html>