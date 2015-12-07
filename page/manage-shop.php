<?php
   require("../deal/dbconfig.php");
   session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>店铺管理</title>
	<link rel="stylesheet" type="text/css" href="../css/mag.css"/>
	<link rel="stylesheet" type="text/css" href="../css/common.css"/>
	<link rel="stylesheet" type="text/css" href="../css/font-awesome-4.4.0/css/font-awesome.css"/>
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript"src = "../js/manage-shop.js"></script>
	<script type="text/javascript" src="../js/common.js"></script>
</head>
<body>
    <div class="top">
	    <div class = "top-logo">
	        <a href="../search.php" class = "top-logo-img"><img src="../images/tit.png"/></a>
	        <span class="place"><span id="place">杭州</span><i class = "fa fa-sort-down "></i></span>
	    	<ul class = "personal">
				<<?php 
				if($_SESSION['islogin'] == true) {
					$nameuser=$_SESSION['name'];
                    $select_user=mysql_query("select * from user where nicknames='$nameuser'")or die(mysql_error());
                    $user_result=mysql_fetch_assoc($select_user);
                    $user_id = $user_result['id'];
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
		
		<div class="manage-wrap">
	        <div class="psd-teb">
	            <div class="teb-mod click" _content="modify-mag">修改店铺信息</div>
	            <div class="teb-mod"  _content="publish-mag">发布优惠信息</div>
	            <div class="teb-mod"  _content="manage-cm">评论管理</div>
	        </div>
	        <div class="modify-mag J_click">
	        	<form method="post" name="modify-msg" id="modify-msg" action="../deal/modify-msg.php" onsubmit="return modifyMsgCheck()" enctype="multipart/form-data">
	                <div class="line">
						<div class="label">选择店铺&nbsp;</div>
						<select class="text-input" name="shop_dm" id="shop_dm">
						<?php
							$select_shopowner = mysql_query("select shop_id from shopowner where user_id = $user_id and pass = 1") or die(mysql_error());
							$select_shopowner_num = mysql_num_rows($select_shopowner);
							for ($i=0; $i < $select_shopowner_num; $i++) { 
								$select_shopowner_result = mysql_fetch_assoc($select_shopowner);
								$owner_shop_id = $select_shopowner_result[shop_id];
								//var_dump($owner_shop_id);
								$select_shop = mysql_query("select * from shop where shop_dm = '$owner_shop_id'") or die(mysql_error());
								$select_shop_result = mysql_fetch_assoc($select_shop);
								//var_dump($select_shop_result);
								echo "<option value= $owner_shop_id >$select_shop_result[shop_mc]</option>";
							}
						?>
						</select>
					</div>
					<div class="line">
						<div class="label">商店名称&nbsp;</div>
						<input type="text" class="text-input" name="shopName" id="shopName"/>
						<div class="label">联系方式&nbsp;</div>
						<input type="text" class="text-input" name="telno" id="telno"/>
					</div>
					<div class="line">
						<div class="label">分类&nbsp;</div>
						<select class="text-input" name="type" id="type">
							<option value="">选择分类</option>
							<option value="A00">衣服饰品</option>
							<option value="B00" >饮食</option>
							<option value="C00">住宿</option>
							<option value="D00" >交通</option>
							<option value="E00" >服务</option>
							<option value="F00" >娱乐</option>
							<option value="G00" >日用品</option>
							<option value="H00">文化教育类</option>
							<option value="I00">医疗相关</option>
							<option value="J00">电子电器</option>
							<option value="K00">公共服务</option>
						</select>
						<div class="label">营业状态&nbsp;</div>
						<select class="text-input" name="shop_state" id="shop_state">
							<option value="">选择营业状态</option>
							<option value="0">正常营业</option>
							<option value="0">装修</option>
							<option value="0">停业中</option>
						</select>
					</div>
					<div class="line">
						<div class="label">环境支持:&nbsp;</div>
						<label><input type="checkbox" class="checkbox"  name="pakking" id="pakking"/> 停车</label>
						<label><input type="checkbox" class="checkbox" name="wc" id="wc"/> 厕所</label>
						<label><input type="checkbox" class="checkbox" name="wifi" id="wifi" /> wife</label>
					</div>
					<div class="line">
						<div class="label">服务支持:&nbsp;</div>
						<label><input type="checkbox" class="checkbox" name="mt" id="mt"/> 美团</label>
						<label><input type="checkbox" class="checkbox" name="bdwm" id="bdwm"/> 百度外卖</label>
						<label><input type="checkbox" class="checkbox" name="zfb" id="zfb"/> 支付宝</label>
						<label><input type="checkbox" class="checkbox" name="tb" id="tb"/> 淘宝</label>
						<label><input type="checkbox" class="checkbox" name="tdd" id="tdd"/> 淘点点</label>
					</div>
					<div class="line" id="addline">
					    <div class="label">上传图片:&nbsp;</div>
						<input type="button" class="addpic" value="添加" />
						<input type="text" style="display:none;" name="n" id="n">
						
					</div>
					<div class="line">
					    <div class="label"></div>
						<input type="submit" value="确&nbsp;认" id="basemagid" class="confirm"/>
					</div>
					<div class="line">
					    <div class="label"></div>
						<div class = "error" id = "error01" style = 'color: red;'></div> 
					</div> 
				</form>
	        </div>
	        <div class="publish-mag J_click">
	            <form action="../deal/public-preferential.php" method="post" onsubmit="return publishPreferentialCheck()">
	            	<div class="line">
						<div class="label">选择店铺&nbsp;</div>
						<select class="text-input" name="shop_dm" id="shop_dm">
						<?php
							$select_shopowner = mysql_query("select shop_id from shopowner where user_id = '$user_id' and pass = 1") or die(mysql_error());
							$select_shopowner_num = mysql_num_rows($select_shopowner);
							for ($i=0; $i < $select_shopowner_num; $i++) { 
								$select_shopowner_result = mysql_fetch_assoc($select_shopowner);
								$owner_shop_id = $select_shopowner_result[shop_id];
								$select_shop = mysql_query("select * from shop where shop_dm = '$owner_shop_id'") or die(mysql_error());
								$select_shop_result = mysql_fetch_assoc($select_shop);
								//var_dump($select_shop_result);
								echo "<option value= $select_shop_result[shop_dm] >$select_shop_result[shop_mc]</option>";
							}
						?>
						</select>
					</div>
	            	<div class="line">
						<div class="label">优惠信息&nbsp;</div>
						<textarea class="textarea-input" id = "preferential-msg" name="preferential-msg"></textarea>
					</div><!-- 
					<div class="line">
						<div class="label">发布时间: &nbsp;</div>
						<input type="text" class="text-input" name="public-time">
					</div> -->
					<div class="line">
						<div class="label">优惠开始时间&nbsp;</div>
						<input type="text" id = "d11" class="text-input" id="start-time" name="start-time" onClick="WdatePicker()">
					</div>
					<div class="line">
						<div class="label">优惠结束时间&nbsp;</div>
						<input type="text" id = "d12" class="text-input" id = "end-time" name="end-time" onClick="WdatePicker()">
					</div>
					<div class="line">
						<div class="label">优惠力度&nbsp;</div>
						<select class="text-input"id = "dynamics" name="dynamics">
							<option value="">请选择</option>
							<option value="1">1</option>
							<option value="2" >2</option>
							<option value="3">3</option>
							<option value="4" >4</option>
							<option value="5" >5</option>
							<option value="6" >6</option>
							<option value="7" >7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>
					<div class="line">
						<div class="label">优惠内容&nbsp;</div>
						<textarea class="textarea-input" id = "p_content" name="p_content"></textarea>
					</div>
					<!-- <div class="line">
						<div class="label">是否过期: &nbsp;</div>
						<select class="text-input" name="expired">
							<option value="0">否</option>
							<option value="1">是</option>
						</select>
					</div> -->
					<div class="line">
					    <div class="label"></div>
						<input type="submit" value="确&nbsp;认" class="confirm"/>
					</div>
					<div class="line">
					    <div class="label"></div>
						<div class = "error" id = "error02" style = 'color: red;'></div> 
					</div> 
	            </form>
	        </div>
	        <?php
	        	$select_comment = mysql_query("select * from comment where user_id = '$user_id' and c_type = '1' order by c_time desc")or die(mysql_error());
	        	$select_comment_num = mysql_num_rows($select_comment);
	        ?>
	        <div class="manage-cm J_click">
	            <div class = "manage-cm-title">评论管理</div>
	            <div class = "manage-cm-content">
	            <?php
	            	for ($i=0; $i < $select_comment_num ; $i++) { 
	            		$select_comment_result = mysql_fetch_assoc($select_comment);
	            		$comment_user_id = $select_comment_result['user_id'];
	            		$select_comment_user = mysql_query("select * from user where id = '$comment_user_id'")or die(mysql_error());
	            		$comment_user_result = mysql_fetch_assoc($select_comment_user) ;
	            		$comment_nickname = $comment_user_result['nicknames'];
	            		$comment_avatar = $comment_user_result['avatar'];
	            		$comment_avatar_url = "../user_photo/".$comment_avatar;
	            		$comment_time = $select_comment_result['c_time'];
	            		$comment_content = $select_comment_result['c_content'];
	            		$comment_photo = $select_comment_result['c_photo'];
	            		$comment_id = $select_comment_result['comment_id'];
	            		$feedback = $select_comment_result['feedback'];
	            ?>
	            	<div class="manage-cm-row">
		            	<div class="origin-person">
		            		<img src= <?php echo "$comment_avatar_url"; ?> width="60px" height="60px">
		            		<span><?php echo "$comment_nickname"; ?></span>
		            	</div>
		            	<div class="origin-content">
			            	<div class="comment-time"><?php echo "$comment_time"; ?></div>
			            	<p><?php echo "$comment_content"; ?></p>
			            	<?php 
			            	if($comment_photo!=''){
			            		$comment_photo_arr=split(',', $comment_photo);
                                $comment_photo_arr_num=count($comment_photo_arr);
			            		echo "<div>";
			            		for ($j=0; $j < $comment_photo_arr_num; $j++) { 
			            			$k = $j+1;
			            			$photo_arr_src[$j]='../user_photo/'.$comment_photo_arr[$j];
			            			echo "<img src = $photo_arr_src[$j]  class = 'comment-img' width = '50px' height = '50px' _number = $k />";
			            		}
			            		echo "</div>";
			            		for ($x=0; $x < $comment_photo_arr_num; $x++) { 
			            			$l = $x+1;
			            			$photo_arr_src[$x]='../user_photo/'.$comment_photo_arr[$x];
				            		$imgBigClass = $l.'img';
				            		echo "<img src = $photo_arr_src[$x]  class = 'comment-img-big $imgBigClass'/>";
			            		}
			            	} 
			            	?>
			            	
			            	<?php 
			            		if($feedback ==0) {
			            			echo "<div class = 'pass-btn pass-btn-click' onclick = commentPass(this,$comment_id)>";
			            			echo "已通过";
			            		}else{
			            			echo "<div class = 'pass-btn' onclick = commentPass(this,$comment_id)>";
			            			echo "确认通过";
			            		} 
			            	?>
			            	</div>
		            		<div class = "reply-btn">我要回复</div>
		            	</div>
		            	<div class = "reply-content reply-content-hidden">
		            		<span class = "reply-content-title">我的回复：</span>
		            		<form method ="post" class = "reply-form" <?php $formId = 'form'.$i; echo "id = $formId name = $formId";?>>
		            			<textarea class = "reply-textarea" <?php $textareaId = 'textarea'.$i; echo "id = $textareaId name = $textareaId";?>></textarea>
		            		    <div class = "submit-reply-btn" onclick=<?php echo "replyComment($i,$comment_id)"?>>回复</div>
		            		</form>
		            	</div>
	            	</div>
	            <?php
	            	}
	            ?>
	            </div>
	        </div>
		</div>
		<!-- <div class="footer">&copy;copyright版权所有</div> -->
	</div>
	<script type="text/javascript"src = "../js/My97DatePicker/WdatePicker.js"></script>
</body>
</html>