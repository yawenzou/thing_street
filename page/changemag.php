<?php
   require("../deal/dbconfig.php");
   session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>个人信息完善</title>
	<link rel="stylesheet" type="text/css" href="../css/mag.css"/>
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
</head>
<body>
    <div class="wrap">
		<div class="header">
			<ul>
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
	        <div class="psd-teb">
	            <div class="teb-mod click" _content="base-mag">基本信息</div>
	            <div class="teb-mod"  _content="psd-bd">修改密码</div>
	        </div>
	        <div class="base-mag J_click">
	        	<form id="magForm" name="magForm" method="post" action="../deal/change-msg.php" enctype="multipart/form-data">
	                <div class="line">
						<div class="label">真实姓名: &nbsp;</div>
						<input type="text" class="text-input"  id="name" name="name"/>
					</div>
					<div class="line">
						<div class="label">手机号码: &nbsp;</div>
						<input type="text" class="text-input" id="cellphone" name="cellphone"/>
					</div>
					<div class="line">
						<div class="label">性别: &nbsp;</div>
						<label><input type="radio" name="sex" value="0" /> 男</label>&nbsp;&nbsp;
						<label><input type="radio" name="sex" value="1" /> 女</label>
					</div>
					<div class="line">
						<div class="label">生日: &nbsp;</div>
						<input type="text" class="text-input" id="birthday" name="birthday"  onClick="WdatePicker()"/>
					</div>
					<div class="line">
						<div class="label">职业: &nbsp;</div>
						<select name="professional" class="text-input">
							<option value="volvo">选择职业</option>
							<option value="1">企业员工</option>
							<option value="2" >事业单位员工</option>
							<option value="3">公务员</option>
							<option value="4" >自由职业</option>
							<option value="5" >全职太太</option>
							<option value="6" >个人经商</option>
							<option value="7" >教师</option>
							<option value="8">学生</option>
							<option value="9">待业</option>
							<option value="0">其他</option>
						</select>
					</div>
					<div class="line">
						<div class="label">头像: &nbsp;</div>
						<input type="file" id="avatar" name="avatar" class="avatar" />
					</div>
					<div class="line">
					    <div class="label"></div>
						<input type="submit" value="确&nbsp;认" id="basemagid" class="confirm"/>
					</div>
					<div class="line">
					    <div class="label"></div>
						<div class = "error" id = "error1"></div>
					</div>
	            </form>
	        </div>
	        <div class="psd-bd J_click">
	            <form id="psdForm" name="psdForm" method="post" onsubmit="return check()" action="../deal/Change-Password.php">
	                <div class="line">
						<div class="label">当前密码: &nbsp;</div>
						<input type="text" class="text-input" id="nowpsd" name="nowpsd" />
					</div>
					<div class="line">
						<div class="label">新密码: &nbsp;</div>
						<input type="text" class="text-input" id="newpsd" name="newpsd" />
					</div>
					<div class="line">
						<div class="label">确认密码: &nbsp;</div>
						<input type="text" class="text-input" id="againpsd" name="againpsd" />
					</div>
					<div class="line">
					    <div class="label"></div>
						<input type="submit" value="确&nbsp;认" id="psdid" class="confirm"/>
					</div>
					<div class="line">
					    <div class="label"></div>
						<div class = "error" id = "error2"></div>
					</div>
					
	            </form>
	        </div>
		</div>
		<div class="footer">&copy;copyright版权所有</div>
	</div>
	<script type="text/javascript"src = "../js/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	    function check() {
			if($("#nowpsd").val() == '') {
				$(".error").text("请输入当前密码！");
				return false;
			}
			else if($("#newpsd").val() == '') {
				$(".error").text("请输入新密码！");
				return false;
			}
			else if($("#newpsd").val() != $("#againpsd").val()){
				$("#error2").text("两次输入密码不一样！");
				return false;
			}
			else{
				return true;
			}
		}
		$(function(){
			$(".teb-mod").click(function(){
				$(".teb-mod").removeClass("click");
				$(this).addClass("click");
				$(".J_click").hide();
				$("."+$(this).attr("_content")).show();
			})
		})
	</script>
</body>
</html>