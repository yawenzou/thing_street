<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<?php
//我是基本信息完善页面
    require("dbconfig.php");
    session_start();
    $nicknames=$_SESSION['name'];
    $name=$_POST['name'];
    $cellphone=$_POST['cellphone'];
    $birthday=$_POST['birthday'];
    $professional=$_POST['professional'];
    $sex=$_POST['sex'];
    $seltuser=mysql_query("select * from user where nicknames='$nicknames'")or die(mysql_error());
    $user_id=mysql_fetch_assoc($seltuser);
    $user_id_data=$user_id['id'];

       $uploaddir = "../user_photo/";//设置文件保存目录 注意包含/       
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
	    $a=strtolower(fileext($_FILES['avatar']['name']));
	    if(!$a){
	    	//$echo_massage = "请上传头像";
	    }
	    else{
		    //判断文件类型   
		    if(!in_array(strtolower(fileext($_FILES['avatar']['name'])),$type))   
		    {   
		        $text=implode(",",$type);  
		        $echo_massage = "您只能上传以下类型文件: ,".$text.",<br>";    
		    }   
		    //生成目标文件的文件名       
		    else{   
		        $filenamea=explode(".",$_FILES['avatar']['name']); 
		        do   
		        {   
		            $filenamea[0]=random(10); //设置随机数长度   
		            $namea=implode(".",$filenamea);   
		            //$name1=$name.".Mcncc";   
		            $uploadfilea=$uploaddir.$namea;
		        }   
		        while(file_exists($uploadfilea));   
		        if (move_uploaded_file($_FILES['avatar']['tmp_name'],$uploadfilea)){
		            if($uploadfilea){   
		                $seltuser=mysql_query("update user set name='$name',cellphone='$cellphone',birthday='$birthday',professional='$professional',sex='$sex',avatar='$namea' where id=$user_id_data;")or die(mysql_error());
		                if($seltuser){
		                	$echo_massage = "您已完善信息！";	
		                }
		            }
		        }   
		   }   
		   
	    }
?>
<div class="message_c_sad" style = 'width: 600px;height: 400px;border: 3px solid #749263;border-radius: 5px;margin: 20px auto;padding: 20px;'>
	<?php 
	if(!$echo_massage) {
		echo "您没有上传内容！";
	}
	else{
	    echo "$echo_massage"; 
	}
	?>
    <p>5秒后将会为您跳转，如果您的浏览器没有自动跳转，请<a href="../page/changemag.php">点击这里</a></p>
</div>
<script>
 setTimeout(function(){
       history.go(-1);
 },5000);

</script>
