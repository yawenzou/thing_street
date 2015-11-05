<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<?php
	require("dbconfig.php");
    session_start();
    $owner=$_SESSION['name'];
    $seltuser=mysql_query("select * from user where nicknames='$owner'")or die(mysql_error());
    $user_id=mysql_fetch_assoc($seltuser);
    $user_id_data=$user_id['id'];//用户id
    $select1=mysql_query("select * from shopowner where user_id='$user_id_data' and pass='1'")or die("选择失败".mysql_error());
    $result1= mysql_fetch_assoc($select1);
    $shop_id= $result1['shop_id'];//店铺id

    $intro=$_POST['preferential-msg'];
    $public_time=$_POST['public-time'];
    $period_start=$_POST['start-time'];
    $period_end=$_POST['end-time'];
    $discount=$_POST['dynamics'];
    $p_content=$_POST['p_content'];
    $expired=$_POST['expired'];
    
    $selectid=mysql_query("select max(id) from preferential")or die("选择失败".mysql_error());
    $idresult=mysql_fetch_array($selectid);
    $id=$idresult[0]+1;

    $insert=mysql_query("insert into preferential(id,owner,intro,publish_time,period_start,period_end,discount,p_content,shop_id,expired) value('$id','$owner','$intro','$public_time','$period_start','$period_end','$discount','$p_content','$shop_id','$expired')") or die("插入数据失败".mysql_error());
    echo "发布优惠信息成功！";

?>
<div class="message_c_sad">
   <p>5秒后将会为您跳转，如果您的浏览器没有自动跳转，请<a href="../page/manage-shop.php">点击这里</a></p>
</div>
<script>
setTimeout(function(){
       window.location.href='../page/manage-shop.php';
 },5000)

</script>