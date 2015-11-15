<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<?php
	require("dbconfig.php");
    session_start();
    $owner=$_SESSION['name'];
    $seltuser=mysql_query("select * from user where nicknames='$owner'")or die(mysql_error());
    $user_id=mysql_fetch_assoc($seltuser);
    $user_id_data=$user_id['id'];//用户id
    // $select1=mysql_query("select * from shopowner where user_id='$user_id_data' and pass='1'")or die("选择失败".mysql_error());
    // $result1= mysql_fetch_assoc($select1);
    // $shop_id= $result1['shop_id'];//店铺id
    $shop_dm=$_POST["shop_dm"];
    //var_dump($shop_dm);

    $intro=$_POST['preferential-msg'];
    $public_time=date('y-m-d h:i:s',time());
    $period_start=$_POST['start-time'];
    $period_end=$_POST['end-time'];
    $discount=$_POST['dynamics'];
    $p_content=$_POST['p_content'];
    $expired=0;
    
    $selectid=mysql_query("select max(id) from preferential")or die("选择失败".mysql_error());
    $idresult=mysql_fetch_array($selectid);
    $id=$idresult[0]+1;

    if(!$intro) {
        $echo_massage = "请输入优惠信息！";
    }
    else if(!$period_start) {
        $echo_massage = "请输入优惠开始时间！";
    }
    else if(!$period_end) {
        $echo_massage = "请输入优惠结束时间！";
    }
    else if(!$discount) {
        $echo_massage = "请输入优惠力度！";
    }
    else if(!$p_content) {
        $echo_massage = "请输入优惠内容！";
    }
    else{
        $insert=mysql_query("insert into preferential (id, owner, intro, publish_time, period_start, period_end, discount, p_content, shop_id,expired) values ('$id', '$owner', '$intro', '$public_time', '$period_start', '$period_end', '$discount', '$p_content', '$shop_dm', '$expired')") or die("插入数据失败".mysql_error());
        if($insert) {
            $echo_massage = "发布优惠信息成功！";
        }
        else {
            $echo_massage = "发布优惠信息失败！";
        }
    }
    

?>

<div class="message_c_sad" style = 'width: 600px;height: 400px;border: 3px solid #749263;border-radius: 5px;margin: 20px auto;padding: 20px;'>
    <?php 
        echo "$echo_massage"; 
    ?>
    <p>5秒后将会为您跳转，如果您的浏览器没有自动跳转，请<a href="../page/manage-shop.php">点击这里</a></p>
</div>
<script>
 setTimeout(function(){
       window.location.href='../page/manage-shop.php';
 },5000)

</script>
