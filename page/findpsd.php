<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>找回密码</title>
	<link rel="stylesheet" type="text/css" href="../css/mag.css"/>
	<link rel="stylesheet" type="text/css" href="../css/common.css"/>
	<link rel="stylesheet" type="text/css" href="../css/font-awesome-4.4.0/css/font-awesome.css"/>
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/common.js"></script>
</head>
<body>
<?php
	session_start();
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
		<div class="findpsd-wrap">
	        <div class="register-teb">
	            <div class="teb-mod">邮箱找回密码</div>
	        </div>
	        <div class="base-mag J_click">
	        	<form id="magForm" name="magForm">
	        		<div class=" magt100"></div>
	                <div class="line">
						<div class="label">邮箱&nbsp;</div>
						<input type="text" id = "findPsdMail" class="text-input" />
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
			change_city();
			$(".psded").click(function(){
				var psdMail = $("#findPsdMail").val();
				var reg = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
				if(!psdMail) {
					alert("请输入邮箱！");
				}
				else if(!reg.test(psdMail)) {
					alert("请输入正确邮箱地址！");
				}
				else {
					$.ajax({
						type: 'POST',
						url:"../deal/findPsdDeal.php",
						data:{mail:psdMail},
						success: function(data) {
					        alert(data);
						},
						error: function() {
							alert("找回密码失败，请重新试一次！");
						}
					})
				}
			})
		})
	</script>
</body>
</html>