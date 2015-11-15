<?php
    require("dbconfig.php");
    session_start();
    $shop_id=$_GET['shop_id'];
    $c=$_GET['c'];    //评论或纠错
    $n=$_GET['n'];    //第几个店铺
    $num=$_GET['num'];  //图片数量
    $nicknames=$_SESSION['name'];
    $seltuser=mysql_query("select * from user where nicknames='$nicknames'")or die(mysql_error());
    $user_id=mysql_fetch_assoc($seltuser);
    $user_id_data=$user_id['id'];
    $c_time=date('y-m-d h:i:s',time());
    $c_type=$c;
    if($c==1){
        $textAreaName="cont-cc".$n;
        $fileNameNum = 'file-img-cc'.$n;
        $feedback = 1;
        $successStr = "评论成功！";
    }
    else{
        $textAreaName="cont-ec".$n;
        $fileNameNum = 'file-img-ec'.$n;
        $feedback = 3;
        $successStr = "纠错上传成功，我们将尽快处理！";
    };
    $c_content=$_POST[$textAreaName];   
    if(!$_SESSION['name']){
    	echo "请先登录！";
    }
    else if(!$c_content){
    	echo "请输入内容！";
    } 
    else{
        $photo = '';
        $uploaddir = '../user_photo/';
        $type=array("jpg","gif","bmp","jpeg","png");//设置允许上传文件的类型

        for ($i = 0;$i < $num; $i++) {
            $j = $i+1;
            $fileNameImg = $fileNameNum.$j;
            if(!$_FILES["$fileNameImg"]['name']) {
                continue;
            }
            if(!in_array(strtolower(fileext($_FILES["$fileNameImg"]['name'])),$type))  //判断文件类型 
            {   
                $text=implode(",",$type); 
                echo "您只能上传以下类型文件: ",$text,"<br>";   
            }
            else{
                //生成目标文件的文件名
                $filename[$j]=explode(".",$_FILES[$fileNameImg]['name']);
                do   
                {   
                    $filename[$j][0]=random($j); //设置随机数长度   
                    $name[$j]=implode(".",$filename[$j]);     
                    $uploadfile[$j]=$uploaddir.$name[$j]; 
                }   
                while(file_exists($uploadfile[$j])); 
                if (move_uploaded_file($_FILES[$fileNameImg]['tmp_name'],$uploadfile[$j])){
                    if($uploadfile[$j]){   
                        $photos=$photos.$name[$j].",";

                    }
                }
            }
        }
        $photos=substr($photos,0,-1);     
        $insertComment = mysql_query("insert into comment (shop_id, user_id, c_content, c_photo, c_time, c_type, feedback) values ('$shop_id', '$user_id_data', '$c_content', '$photos', '$c_time', '$c_type', '$feedback')" )or die(mysql_error());
        //var_dump($insertComment);
        
        if($insertComment){
            echo "$successStr";
        }
    }  

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
    
?>
