<?php 
require("deal/dbconfig.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>东西街搜索</title>
	<link rel="stylesheet" type="text/css" href="css/search.css"/>
	<link rel="stylesheet" type="text/css" href="css/common.css"/>
	<link rel="stylesheet" type="text/css" href="css/font-awesome-4.4.0/css/font-awesome.css"/>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/banner.js"></script>
</head>
<body>
<?php
	session_start();
?>
    <div class="top">
	    <div class = "top-logo">
	        <a href="search.php" class = "top-logo-img"><img src="images/tit.png"/></a>
	        <span class="place"><span id="place">杭州</span><i class = "fa fa-sort-down "></i></span>
	    	<ul class = "personal">
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
	    	<a href = "index.php?street=3301041002&n_c=1&street_direction_data=0&direction_data=2">文渊路</a>
	    	<a href = "index.php?street=3301040001&n_c=1&street_direction_data=1&direction_data=5">学林街</a></p>
	    </div>
    </div>
    <div class="wrap">
		<div class="search" id="search">
			<input class="ser" type="text" id="ser" title="街道、建筑、商店之间用空格分开" placeholder = "请输入关键字 街道、建筑、商店之间用空格分开 "/>
			<div class="ser-ico" id="ser-ico" title="街道、建筑、商店之间用空格分开"><i class = "fa fa-search"></i></div>
			<ul class='sertext' id='sertext'></ul>
		</div>
		<div class = "banner">
			<ul class = "banner-img">
				<li class = "banner-img1 banner-img-li"><img src="images/banner1.png"/></li>
				<li class = "banner-img2 banner-img-li">
					<div class="coupon">
						<h2>店铺优惠信息</h2>
						<ul class="th">
							<li class='w180'>优惠信息</li>
							<li class='w80'>优惠店铺</li>
							<li class='w150'>优惠时间段</li>
						</ul>
						<marquee behavior="scroll" direction="up" loop="-1" scrollamount="3" height="165px;" scrolldelay="0" onMouseOut="this.start()" onMouseOver="this.stop()">	
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
										echo "<td class='w180' title=$perfer_result_content>$perfer_result_intro</td>";
										echo "<td class='w80' title=$shop_result_name>$shop_result_name</td>";
										echo "<td class='w150' title='$perfer_result_timestart - $perfer_result_timeend'>$perfer_result_timestart - $perfer_result_timeend</td>";
									echo "</tr>";
								}
							?>		
						</table>
						</marquee>
					</div>
				</li>
				<li class = "banner-img3 banner-img-li"><img src="images/banner3.jpg"/></li>
				<li class = "banner-img4 banner-img-li"><img src="images/banner4.jpg"/></li>
				<li class = "banner-img5 banner-img-li"><img src="images/banner5.jpg"/></li>
			</ul>
		</div>
		<ul class = "banner-progressbar">
			<li class = "left-icon"><i class="fa fa-caret-left"></i></li>
			<li class = "right-icon"><i class="fa fa-caret-right"></i></li>
			<li>
				<ul class = "banner-progressbar-ul">
					<li class = "circle"><i class = "fa fa-circle"></i></li>
					<li class ="banner-progressbar-li" _number = "0"></li>
					<li class ="banner-progressbar-li" _number = "1"></li>
					<li class ="banner-progressbar-li" _number = "2"></li>
					<li class ="banner-progressbar-li" _number = "3"></li>
					<li class ="banner-progressbar-li" _number = "4"></li>
				</ul>
			</li>
		</ul>
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
	<div class="footer"></div>

	
	<script type="text/javascript">
		searchtext();
		detail();
		change_city();
		banner();
	</script>
</body>
</html>