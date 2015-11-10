<?php
//我是店主界面认领店铺处理代码

	require("dbconfig.php");
    session_start();
    $shop_id=$_GET['shop_id'];
    $nicknames=$_SESSION['name'];
    $seltuser=mysql_query("select * from user where nicknames='$nicknames'")or die(mysql_error());
    $user_id=mysql_fetch_assoc($seltuser);
    $user_id_data=$user_id['id'];
    $ownertime=date('y-m-d',time());
    $name=$_POST["username"];
    $cellphone=$_POST["tellphone"];
    $identity_card=$_POST["identity_card"];
    if(!$_SESSION['name']){
    	echo "请先登录！";
    }
    else if(!$name){
    	echo "请输入姓名！";
    }
   /*else if(!preg_match("/^[\x80-\xff]{4,8}$/",$name)){
    	echo "请输入正确的姓名！";
    }*/
    else if(!$cellphone){
    	echo "请输入手机号码！";
    }
    /*else if(!strlen($cellphone) == "11"){
    	echo "请输入正确的手机号码！";
    }
    else if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$cellphone)){
    	echo "请输入正确的手机号码！";
    }*/
    else if(!$identity_card){
    	echo "请输入身份证号码！";
    }
    /*else if(!preg_match("/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/",$identity_card)){
    	echo "请输入正确的身份证号码！";
    }*/
    else{
    	$uploaddir = "../license-photos/";//设置文件保存目录 注意包含/       
	    $type=array("jpg","gif","bmp","jpeg","png");//设置允许上传文件的类型    
	    //获取文件后缀名函数   
	    function fileext($filename)   
	    {   
	        return substr(strrchr($filename, '.'), 1);   
	    }   
	    //生成随机文件名函数       
	    function random($length)   
	    {   
	        $hash = 'CR-';   
	        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';   
	        $max = strlen($chars) - 1;   
	        mt_srand((double)microtime() * 1000000);   
	            for($i = 0; $i < $length; $i++)   
	            {   
	                $hash .= $chars[mt_rand(0, $max)];   
	            }   
	        return $hash;   
	    }   
	    $a=strtolower(fileext($_FILES['business_license']['name']));
	    $b=strtolower(fileext($_FILES['Organization_Certificate']['name']));
	    if(!$a){
	    	echo "请上传营业执照";
	    }
	    elseif (!$b) {
	     	echo "请上传组织结构代码证";
	    }
	    else{
		    //判断文件类型   
		    if(!in_array(strtolower(fileext($_FILES['business_license']['name'])),$type)||!in_array(strtolower(fileext($_FILES['Organization_Certificate']['name'])),$type))   
		    {   
		        $text=implode(",",$type);   
		        echo "您只能上传以下类型文件: ",$text,"<br>";   
		    }   
		    //生成目标文件的文件名       
		    else{   
		        $filenamea=explode(".",$_FILES['business_license']['name']); 
		        $filenameb=explode(".",$_FILES['Organization_Certificate']['name']);   
		        do   
		        {   
		            $filenamea[0]=random(10); //设置随机数长度   
		            $namea=implode(".",$filenamea);   
		            //$name1=$name.".Mcncc";   
		            $uploadfilea=$uploaddir.$namea;
		            $filenameb[0]=random(11); //设置随机数长度   
		            $nameb=implode(".",$filenameb);   
		            //$name1=$name.".Mcncc";   
		            $uploadfileb=$uploaddir.$nameb;   
		        }   
		        while(file_exists($uploadfilea)&&file_exists($uploadfileb));   
		        if (move_uploaded_file($_FILES['business_license']['tmp_name'],$uploadfilea)&&move_uploaded_file($_FILES['Organization_Certificate']['tmp_name'],$uploadfileb)){
		            if($uploadfilea&&$uploadfileb){   
		                $seltuser=mysql_query("update user set name='$name',cellphone='$cellphone',identity_card='$identity_card',u_type='1' where id=$user_id_data;");
		                $selt_shopowner=mysql_query("insert into shopowner (shop_id,user_id,business_license,organization_code,ownertime) values ('$shop_id','$user_id_data','$namea','$nameb','$ownertime')")or die(mysql_error());
		                // var_dump($selt_shopowner);
		                // var_dump($seltuser);
		                echo "我们将会尽快为你验证，请等待通知！";
		            }
		        }   
		   }   
		   
	    }   	
    }

  //  header('Location:../index.php');
?>
<div class="message_c_sad">
    <p>5秒后将会为您跳转，如果您的浏览器没有自动跳转，请<a href="../index.php">点击这里</a></p>
</div>
<script>
 setTimeout(function(){
       window.location.href='../index.php';
 },5000)

</script>