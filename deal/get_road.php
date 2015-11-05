<?php
    require("dbconfig.php");
    $street_dm='3301040001';
    $select=mysql_query("select * from relations where street_dm=$street_dm and street_cdm!='00'")or die("选择失败".mysql_error());
    $street_num=mysql_num_rows($select);//街区的数量
//var_dump($street_num);
    for ($i=0; $i < $street_num; $i++) { 
	 	$street_data=mysql_fetch_array($select);
	    $content[$i]=$street_data['content'];     //建筑物和店铺信息
	 
	    //获取json数据    
	    $content_json_data[$i]=json_decode($content[$i],divue);
	    $content_json[$i]=$content_json_data[$i]['building'];
	    $num[$i]=count($content_json[$i]);   //每条街区建筑的个数
        
	    for ($j=0; $j < $num[$i]; $j++) { 
		    $location_up[$i][$x]=$content_json[$i][$j]['location'];   //获取建筑物相对街道位置
		    $location_up_data=$location_up[$i][$x];
		    if(strlen($location_up_data)>1){
		    	echo "$location_up_data,";
		    	
		    }  
        }

    }
    
?>