<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<?php
	require("dbconfig.php");
	session_start();
	$nicknames=$_SESSION['name'];
	$seltuser=mysql_query("select * from user where nicknames='$nicknames'")or die(mysql_error());
    $user=mysql_fetch_assoc($seltuser);
    $user_id_data=$user['id'];
    $password_data=$user['password'];
    $nowpsd=$_POST['nowpsd'];
    $newpsd=$_POST['newpsd'];
    $newpsdmd5=md5(trim($newpsd));
    $againpsd=$_POST['againpsd'];
    if (md5(trim($nowpsd))!=$password_data) {
        $echo_massage = "当前密码错误！";
    }
    else if($againpsd!=$newpsd) {
        $echo_massage = "两次输入密码不一致";
    }
    else{
    	$insert=mysql_query("update user set password='$newpsdmd5' WHERE id = '$user_id_data' ")or die(mysql_error());
        if($insert) {
            $echo_massage = "修改密码成功！";
        }
    }
?>

<div class="message_c_sad" style = 'width: 600px;height: 400px;border: 3px solid #749263;border-radius: 5px;margin: 20px auto;padding: 20px;'>
    <?php 
        echo "$echo_massage"; 
    ?>
    <p>5秒后将会为您跳转，如果您的浏览器没有自动跳转，请<a href="../page/changemag.php">点击这里</a></p>
</div>
<script>
 setTimeout(function(){
       history.go(-1);
 },5000);

</script>