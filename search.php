<?php 
require("deal/dbconfig.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>东西街搜索</title>
	<link rel="stylesheet" type="text/css" href="css/search.css"/>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
</head>
<body>
<?php
	session_start();
?>
    <div class="header">
    	<ul>
			<?php 
				if($_SESSION['islogin'] == true) {
					$nameuser=$_SESSION['name'];
                    $select_user=mysql_query("select * from user where nicknames='$nameuser'")or die(mysql_error());
                    $user_result=mysql_fetch_assoc($select_user);
                    $u_type=$user_result['u_type'];
                    if ($u_type=='1') {
                        echo "<li class='news'><a href='page/manage-shop.php'>管理店铺</a></li>";
                    }
					// echo "<li class='news'><a href='###'>消息</a></li>";
					echo "<li class='pers'><a href='page/changemag.php'>".$_SESSION['name']."</a></li>";
					echo "<li class='drop'><a href='deal/delete-session.php' target='_top'>安全退出</a></li>";
				}
				else {
					echo "<li><a href='page/register.php?q=search'>注册</a></li>";
					echo "<li><a href='page/login.php?q=search'>登录</a></li>";
				}
			?>
    		
    	</ul>
    </div>
    <div class="mid">
		<!-- <div class="logo">
			<img src="images/tit.gif"/>
		</div> -->
		<div class="logo"><a href="search.php"><img src="images/tit.png"/></a></div>
		<span class="place" id="place">杭州</span>
		<span class="change-place">[切换城市]</span>
		<div class="search" id="search">
			<input class="ser" type="text" id="ser" title="街道、建筑、商店之间用空格分开"/>
			<div class="ser-ico" id="ser-ico" title="街道、建筑、商店之间用空格分开">搜索</div>
			<ul class='sertext' id='sertext'></ul>
		</div>
		<div class="shangecity">
			<ul>
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
	</div>
	<div class="coupon">
		<h2>店铺优惠信息</h2>
		<ul class="th">
			<li class='w250'>优惠信息</li>
			<li class='w100'>优惠店铺</li>
			<li class='w150'>优惠时间段</li>
		</ul>
		<marquee behavior="scroll" direction="up" loop="-1" scrollamount="3" height="140px;" scrolldelay="0" onMouseOut="this.start()" onMouseOver="this.stop()">	
		<table class="privilege-list" cellpadding="0" cellspacing="0" border="0">
			<?php 
				$select_prefer=mysql_query("select * from preferential where expired='0'")or die(mysql_error()); 
				$perfer_num=mysql_num_rows($select_prefer);
				for ($i=0; $i < $perfer_num; $i++) {
					$perfer_result=mysql_fetch_assoc($select_prefer);
					$perfer_result_intro=$perfer_result['intro'];
					$perfer_result_content=$perfer_result['p_content'];
					$perfer_result_timestart=$perfer_result['period_start'];
					$perfer_result_timeend=$perfer_result['period_end'];
					$perfer_result_shop=$perfer_result['shop_id'];
					$select_shop=mysql_query("select * from shop where shop_dm='$perfer_result_shop'")or die(mysql_error()); 
					$shop_result=mysql_fetch_assoc($select_shop);
					$shop_result_name= $shop_result['shop_mc'];
					echo "<tr class='J_detail' _num='$i' _shopId = '$perfer_result_shop'>";
						echo "<td class='w250' title=$perfer_result_content>$perfer_result_intro</td>";
						echo "<td class='w100' title=$shop_result_name>$shop_result_name</td>";
						echo "<td class='w150' title='$perfer_result_timestart - $perfer_result_timeend'>$perfer_result_timestart - $perfer_result_timeend</td>";
					echo "</tr>";
				}
			?>		
		</table>
		</marquee>
	</div>
		<?php 

		$select_prefer2=mysql_query("select * from preferential where expired='0'")or die(mysql_error());
		for ($j=0; $j < $perfer_num; $j++) {
			$perfer_result2=mysql_fetch_assoc($select_prefer2);
			$perfer_result_content=$perfer_result2['p_content'];
	echo "<div class='pref_content'";$idval='content'.$j;  echo " id=$idval>
		<div class='pref_content-title'>优惠详情<span class='close'>x</span></div>
		<p>";
			echo "$perfer_result_content";
		echo "</p>";
		echo "<a href = '###' class = 'enter-shop-btn'>进店查看</a>";
	echo "</div>";
		}
		?>
	<!-- <div class="footer">&copy;copyright版权所有</div> -->

	
	<script type="text/javascript">
		searchtext();
		detail();
		change_city();
	</script>
</body>
</html>