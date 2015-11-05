
<?php 
    require("dbconfig.php");
    session_start();
    $street_dm_click=$_GET['street'];
    if ($street_dm_click!='') {
        $street_dm=$street_dm_click; 
    
    }
    elseif (isset($_SESSION['dm'])) {
       $street_dm=$_SESSION['dm'];
    }
    else {
        $street_dm='3301040001';
    }

    $select=mysql_query("select * from relations where street_dm=$street_dm and street_cdm!='00'")or die("选择失败".mysql_error());
    $street_num=mysql_num_rows($select);//街区的数量
    echo "$street_num".",";
    for($i=0;$i<$street_num;$i++){
   	    $street_data=mysql_fetch_array($select);
   	    $content[$i]=$street_data['content'];   //建筑物和店铺信息
        
        $content_json_data[$i]=json_decode($content[$i],true);//获取json数据 
        $content_json[$i]=$content_json_data[$i]['building']; 
        
        $num[$i]=count($content_json[$i]);   //每条街区建筑的个数
        
        $direction_up_num[$i]=0;    //建筑物在街道的上边的数量
        $direction_down_num[$i]=0;    //建筑物在街道的下边的数量
        $n1=0; //街道上边长度单位
        $n2=0;  //街道下边长度单位
        for ($j=0; $j < $num[$i]; $j++) { 
            $direction[$i]=$content_json[$i][$j]['direction'];
            if($direction[$i]=='1'||$direction[$i]=='5'||$direction[$i]=='6'){ //判断建筑物在街道的哪一边
                $x=$direction_up_num[$i];  //建筑物编号
                $direction_up_num[$i]++;   //建筑物数量
                
                $building_type_up[$i][$x]= $content_json[$i][$j]['type']; //获取建筑物类型
                $shop_up[$i][$x]=$content_json[$i][$j]['shop'];//第$i个街区第$X个建筑的商店信息
                $shop_up_num[$i][$x]=count($shop_up[$i][$x]);  //第$i个街区第$X个建筑的商店数量
                $n1=$n1+$shop_up_num[$i][$x];   //街道上边商店数量
               // var_dump($n1);
            }
           else if ($direction[$i]=='2'||$direction[$i]=='3'||$direction[$i]=='4') {//在街道下边
                $x=$direction_down_num[$i];
                $direction_down_num[$i]++;

                $building_type_down[$i][$x]= $content_json[$i][$j]['type']; //获取建筑物类型
                $shop_down[$i][$x]=$content_json[$i][$j]['shop'];//第$i个街区第$X个建筑的商店信息
                $shop_down_num[$i][$x]=count($shop_down[$i][$x]);  //第$i个街区第$X个建筑的商店数量
                $n2=$n2+$shop_down_num[$i][$x];   //街道下边商店数量
            }
           
        }
        //var_dump($n1);
        $n1=$n1+$direction_up_num[$i];   //加上街道间空地数量
        $n2=$n2+$direction_down_num[$i];  //加上街道间空地数量
        for ($k=0; $k < $direction_up_num[$i]; $k++) {
            $building_type_up_data=$building_type_up[$i][$k];
            if($building_type_up_data=='20'||$building_type_up_data=='21') {//路口类型为两个单位长度
                $n1=$n1+2;   
            }
        }
        for ($k=0; $k < $direction_down_num[$i]; $k++) {
            $building_type_down_data=$building_type_down[$i][$k];
            if($building_type_down_data=='20'||$building_type_down_data=='21') {
                $n2=$n2+2;
            }
        }

	    echo "$n1".",";
	    echo "$n2".",";
    }
   mysql_close($link); 
?>