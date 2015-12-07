<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>东西街登录</title>
	<link rel="stylesheet" type="text/css" href="../css/mag.css"/>
	<link rel="stylesheet" type="text/css" href="../css/common.css"/>
	<link rel="stylesheet" type="text/css" href="../css/font-awesome-4.4.0/css/font-awesome.css"/>
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/ajax.js"></script><!---->
	<script type="text/javascript" src="../js/common.js"></script>
</head>
<body>
<?php
	session_start();
	$q=$_GET['q'];
?>
    <div class="top">
	    <div class = "top-logo">
	        <a href="../search.php" class = "top-logo-img"><img src="../images/tit.png"/></a>
	        <span class="place"><span id="place">杭州</span><i class = "fa fa-sort-down "></i></span>
	    	<ul class = "personal">
				<?php 
					if($_SESSION['islogin'] == true) {
						$nameuser=$_SESSION['name'];
	                    $select_user=mysql_query("select * from user where nicknames='$nameuser'")or die(mysql_error());
	                    $user_result=mysql_fetch_assoc($select_user);
	                    $u_type=$user_result['u_type'];
	                    if ($u_type=='1') {
	                        echo "<li class='news'><a href='manage-shop.php'>管理店铺</a></li>";
	                    }
						// echo "<li class='news'><a href='###'>消息</a></li>";
						echo "<li class='pers'><a href='changemag.php'>".$_SESSION['name']."</a></li>";
						echo "<li class='drop'><a href='../deal/delete-session.php' target='_top'>安全退出</a></li>";
					}
					else {
						echo "<li><a href='register.php?q=search'>注册</a></li>";
						echo "<li><a href='login.php?q=search'>登录</a></li>";
					}
				?>
	    		
	    	</ul>
	    	<ul class="shangecity">
				<li>杭州</li>
				<li>上海</li>
				<li>深圳</li>
				<li>武汉</li>
				<li>长沙</li>
				<li>南昌</li>
				<li>南京</li>
				<li>厦门</li>
				<li>天津</li>
			</ul>
	    </div>
	    <div class = "top-bottom">
	    	<p>推荐街道：
	    	<a href = "../index.php?street=3301041002&n_c=1&street_direction_data=0&direction_data=2">文渊路</a>
	    	<a href = "../index.php?street=3301040001&n_c=1&street_direction_data=1&direction_data=5">学林街</a></p>
	    </div>
    </div>
    <div class="wrap">
		<!-- <div class="logo">
			<a href="../search.php"><img src="../images/tit.gif"/></a>
		</div> -->
		<!-- <div class="logon-title"><a href="../search.php"><img src="../images/tit.png"/></a></div> -->
		<div class="logon-wrap">
			<div class="logon-wrap-title">登 录</div>
			<form action="../deal/login_judge.php" method="post">
				<div class="line">
					<div class="labeld">用户名 &nbsp;</div>
					<input type="text" class="loginput" name="user" id="user"/>
				</div>
				<div class="line">
					<div class="labeld">密 码</div>
					<input type="password" class="loginput" name="password" id="password"/>
				</div>
				<div class="line-other">
				    <label><div class="labeld"></div>
					<input type="checkbox" name="rembercode" checked="checked"> 记住密码&nbsp;</label>
					<!-- <input type="checkbox" name="autoenter"> 自动登录 -->
				</div>
				<div class="line-02">
					<div class="labeld"></div>
					<div class="code" onclick="login()">登 录</div>
				</div>
				<div class="line-02">
					<div class="labeld"></div>
					<div class="fogetcode"><a href="findpsd.php">忘记密码？</a></div>
					<div class="register">还没账号?<a href="register.php">注册>></a></div>
					<br/>
				    <div id="error" style="margin-top: 5px;"></div>
				</div>
			</form>
		</div>
		<!-- <div class="footer">&copy;copyright版权所有</div> -->
	</div>
	<div class="footer"></div>
	<script type="text/javascript">
		change_city();
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