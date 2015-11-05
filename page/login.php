<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>东西街登录</title>
	<link rel="stylesheet" type="text/css" href="../css/mag.css"/>
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/ajax.js"></script><!---->
</head>
<body>
<?php
	session_start();
	$q=$_GET['q'];
?>
    <div class="wrap">
    	<div class="header">
			<ul>
				<?php 
				if($_SESSION['islogin'] == true) {
					echo "<li class='news'><a href='###'>消息</a></li>";
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
		<div class="logo">
			<a href="../search.php"><img src="../images/tit.gif"/></a>
		</div>
		<div class="logon-wrap">
			<form action="../deal/login_judge.php" method="post">
				<div class="line">
					<div class="labeld">账 号: &nbsp;</div>
					<input type="text" class="loginput" name="user" id="user"/>
				</div>
				<div class="line">
					<div class="labeld">密 码: &nbsp;</div>
					<input type="password" class="loginput" name="password" id="password"/>
				</div>
				<div class="line">
				    <div class="labeld"></div>
					<input type="checkbox" name="rembercode"> 记住密码&nbsp;
					<input type="checkbox" name="autoenter"> 自动登录
				</div>
				<div class="line">
					<div class="labeld"></div>
					<div class="code" onclick="login()">登 录</div>
				</div>
				<div class="line">
					<div class="labeld"></div>
					<div class="fogetcode"><a href="findpsd.php">忘记密码？</a></div>
					<div class="register">还没账号?<a href="register.php">注册>></a></div>
				</div>
				<div id="error"></div>
			</form>
		</div>
		<div class="footer">&copy;copyright版权所有</div>
	</div>
	<script type="text/javascript">
		function login(){
			var ajax = new Ajax();
			var user = document.getElementById("user").value;
			var psw = document.getElementById("password").value;

			if((user=="") && (user=="psw")){
				document.getElementById('error').innerHTML = '请输入用户名和密码!';
			}
			else if((user=="") || (user=="psw")){
				document.getElementById('error').innerHTML = '请输入用户名或密码!';
			}
			else{
				ajax.post("../deal/login_judge.php",{user:user,password:psw},function(data){
					//alert(data);
					var back = eval('(' +data+')');
					if(back.login){ 
						var qq;
						<?php
						if ($q=='index') {
							echo "qq=1;";
						}
						else echo "qq=2;";
						?>
						if(qq==1){
							window.location.href = "../index.php";
						}
						else window.location.href = "../search.php";
					}else {
						document.getElementById('error').innerHTML = back.problem;
						document.getElementById("user").value = "";
    					document.getElementById("password").value = "";  
					}
				})
			}	
		}
	</script>
</body>
</html>