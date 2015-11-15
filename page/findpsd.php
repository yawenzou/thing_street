<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>找回密码</title>
	<link rel="stylesheet" type="text/css" href="../css/mag.css"/>
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
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
		<div class="psd-wrap">
	        <div class="register-teb">
	            <div class="teb-mod">邮箱找回密码</div>
	        </div>
	        <div class="base-mag J_click">
	        	<form id="magForm" name="magForm">
	        		<div class=" magt100"></div>
	                <div class="line">
						<div class="label">邮箱&nbsp;</div>
						<input type="text" class="text-input" />
					</div>
					<div class="line">
					    <div class="label"></div>
						<div class="psdnow psded" id="psd">确认</div>
					</div>
					
	            </form>
	        </div>
		</div>
		<!-- <div class="footer">&copy;copyright版权所有</div> -->
	</div>
	<script type="text/javascript">
		$(function(){
			$(".psded").click(function(){
				alert("新密码已发送到您的邮箱，请注意查收！")
			})
		})
	</script>
</body>
</html>