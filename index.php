<?php
   require("deal/dbconfig.php");
   session_start();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" rel="stylesheet" type="text/css"/>
<link href="css/shop-building.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/play.js" ></script>
<script type="text/javascript" src="js/index.js" ></script>
<title>东西街</title>
<script type="text/javascript">
<?php
    $a=$_GET['n_c'];
    $dir_data=$_GET['direction_data'];
    $street_dir_data=$_GET['street_direction_data'];
    //$dir_data=$_GET['direction_data'];
    if ($street_dir_data=='') {$street_dir_data='10';};
    if ($dir_data=='') {$dir_data='10';};
    //var_dump($dir_data);

    if ($a=='') {
        if (isset($_SESSION['cmd'])) {
            $a=$_SESSION['cmd'];
        }
        else {
            $a=1;
        }
    }

    if($a<10){
        $recmd='0'.$a;
    }
    else $recmd=$a;
    $_SESSION['cmd'] = $a;
    echo "Number=$a;";
    echo "dir_data=$dir_data;";
    echo "street_dir_data=$street_dir_data;";

?>
</script>
</head>

<body>
<div id="header">

    <div class="head">
        <ul>
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
                  echo "<li><a href='page/register.php?q=index'>注册</a></li>";
                  echo "<li><a href='page/login.php?q=index'>登录</a></li>";
                }
            ?>
        </ul>
    </div>
   <div id="title"><a href="search.php"><img src="images/tit.gif"></a></div>
<?php
    $street_dm_click0=$_GET['street'];
    if ($street_dm_click0!='') {
        $street_dm=$street_dm_click0;
    }
    elseif (isset($_SESSION['dm'])) {
            $street_dm=$_SESSION['dm'];
    }/*显示的街区代码*/
    else {
            $street_dm='';
    }
   
    $_SESSION['dm'] = $street_dm;
    $select=mysql_query("select * from relations where street_dm=$street_dm and street_cdm!='00'")or die("选择失败".mysql_error());
    $select_0=mysql_query("select * from relations where street_dm=$street_dm and street_cdm='00'")or die("选择失败".mysql_error());
    $street_num=mysql_num_rows($select);//街区的数量
    if ($street_num==0) {
        echo "<script>alert('您查询的页面没有建筑，请搜索另外的街道！');history.go(-1);</script>";
    }
?>  
<?php
   $selectmc=mysql_query("select * from relations where street_dm=$street_dm and street_cdm=$recmd")or die("选择失败".mysql_error());
   $street_mc=mysql_fetch_array($selectmc);
   $street_mc_0=mysql_fetch_array($select_0);
   $street_mc__data_0 = $street_mc_0['street_mc'];

   echo "<div class='ser'>";
       /*echo "<div class='search-street'>";
            echo "<form  method='post'>";
                echo "<input type='text' name='t1' size='15'/>
                    <input type='submit' value='查询' name='ser1'/>";
            echo "</form>";
        echo "</div>";*/

        //选择详细街道地址
        $street_dm_data=$street_mc['street_dm'];
        $street_mc_data=$street_mc['street_mc'];
        $street_province=substr($street_dm_data,0,2);
        $street_province_number=$street_province.'0000';
        $street_city=substr($street_dm_data, 0,4);
        $street_city_number=$street_city.'00';
        $street_county_number=substr($street_dm_data, 0,6);
        $address_select_province=mysql_query("select city_mc from d_city where city_dm='$street_province_number'")or die("选择失败".mysql_error());
        $address_select_city=mysql_query("select city_mc from d_city where city_dm='$street_city_number'")or die("选择失败".mysql_error());
        $address_select_county=mysql_query("select city_mc from d_city where city_dm='$street_county_number'")or die("选择失败".mysql_error());
        $address_province=mysql_fetch_assoc($address_select_province);
        $address_province_data=$address_province['city_mc'];
        $address_county=mysql_fetch_assoc($address_select_county);
        $address_county_data=$address_county['city_mc'];
        $address_city=mysql_fetch_assoc($address_select_city);
        $address_city_data=$address_city['city_mc'];
        echo "<p>当前街区：$address_province_data-$address_city_data-$address_county_data-$street_mc__data_0-$street_mc_data</p>";   
    echo "</div>";
    $street_speed=$street_mc['speed'];

echo "</div>";
echo "<div id='main'>";
    echo "<div id='content'>";  
      echo "<div id='intro'  style='overflow:hidden;'>"; 
            
            for ($i=0; $i < $street_num; $i++) {
                $select_data[$i]= mysql_fetch_array($select);
                
                $street_data=$select_data[$i];
                //var_dump($select_data[$i]);
                $street_dm[$i]=$street_data['street_dm'];
                $street_cdm[$i]=$street_data['street_cdm'];
                $street_mc[$i]=$street_data['street_mc'];
                $street_direction[$i]=$street_data['direction'];
                $street_stype[$i]=$street_data['street_stype'];
                $content[$i]=$street_data['content'];     //建筑物和店铺信息
             
                //获取json数据    
                $content_json_data[$i]=json_decode($content[$i],divue);
                $content_json[$i]=$content_json_data[$i]['building'];
                $num[$i]=count($content_json[$i]);   //每条街区建筑的个数
        

                //获取建筑物和店铺信息
                $direction_up_num[$i]=0;    //建筑物在街道的上边的数量
                $direction_down_num[$i]=0;    //建筑物在街道的下边的数量
                for ($j=0; $j < $num[$i]; $j++) { 

                    $direction[$i]=$content_json[$i][$j]['direction'];//var_dump($direction[$i]);
                    //var_dump($direction[$i]);
                    if($direction[$i]=='1'||$direction[$i]=='5'||$direction[$i]=='6'){ //判断建筑物在街道的哪一边
                        $x=$direction_up_num[$i];  //建筑物编号
                        $direction_up_num[$i]++;   //建筑物数量

                        //获取门前空地信息
                        $space_up[$i][$x]= $content_json[$i][$j]['space'];

                        if($space_up[$i][$x]=='1'){
                            $space_img[$i]="space_img/3.jpeg";
                        }
                        else if($space_up[$i][$x]=='2'){
                            $space_img[$i]="space_img/gc.jpeg";
                        }
                        else if($space_up[$i][$x]=='3'){
                            $space_img[$i]="space_img/2.jpeg";
                        }
                        else if($space_up[$i][$x]=='4'){
                            $space_img[$i]="space_img/lh.jpeg";
                        }
                        else if($space_up[$i][$x]=='5'){
                            $space_img[$i]="space_img/kd.jpeg";
                        }
                    
                        $building_type_up[$i][$x]= $content_json[$i][$j]['type']; //获取建筑物类型
                        //var_dump($space_up[$i][$x]);
                        $building_mc_up[$i][$x]= $content_json[$i][$j]['building_mc']; //获取建筑物名称
                        $location_up[$i][$x]=$content_json[$i][$j]['location'];   //获取建筑物相对街道位置
                        $direction_up[$i][$x]=$content_json[$i][$j]['direction'];   //获取建筑物相对街道方向
                       // var_dump($building_mc_up[$i][$x]);
                        $shop_up[$i][$x]=$content_json[$i][$j]['shop'];//第$i个街区第$X个建筑的商店信息
                        $shop_up_num[$i][$x]=count($shop_up[$i][$x]);  //第$i个街区第$X个建筑的商店数量
                        // var_dump($shop_up[$i][$x]);
                        // var_dump($shop_up_num[$i][$x]);
                        for ($y=0; $y < $shop_up_num[$i][$x]; $y++) { 
                            $shop_type_shop_dm[$i][$x][$y]=$content_json[$i][$j]['shop'][$y]['shop_dm'];
                            $shop_type_up[$i][$x][$y]=$content_json[$i][$j]['shop'][$y]['type'];
                            $shop_type_mc_up[$i][$x][$y]=$content_json[$i][$j]['shop'][$y]['type_mc'];
                            //$shop_type_up_data=$shop_type_up[$i][$x][$y];
                            //var_dump($content_json[$i][$x]['shop'][$y]);
                            //echo "$shop_type_up_data";
                        }
                    }
                    else if ($direction[$i]=='2'||$direction[$i]=='3'||$direction[$i]=='4') {//在街道下边
                        $x=$direction_down_num[$i];
                        $direction_down_num[$i]++;

                        //获取门前空地信息
                        $space_down[$i][$x]= $content_json[$i][$j]['space'];
                        if($space_down[$i][$x]=='1'){
                            $space_img[$i]="space_img/3.jpeg";
                        }
                        else if($space_down[$i][$x]=='2'){
                            $space_img[$i]="space_img/gc.jpeg";
                        }
                        else if($space_down[$i][$x]=='3'){
                            $space_img[$i]="space_img/2.jpeg";
                        }
                        else if($space_down[$i][$x]=='4'){
                            $space_img[$i]="space_img/lh.jpeg";
                        }
                        else if($space_down[$i][$x]=='5'){
                            $space_img[$i]="space_img/kd.jpeg";
                        }

                        $building_mc_down[$i][$x]= $content_json[$i][$j]['building_mc']; //获取建筑物名称
                        $building_type_down[$i][$x]= $content_json[$i][$j]['type']; //获取建筑物类型
                        $location_down[$i][$x]=$content_json[$i][$j]['location'];   //获取建筑物相对街道位置
                        $direction_down[$i][$x]=$content_json[$i][$j]['direction'];   //获取建筑物相对街道方向
                        $shop_down[$i][$x]=$content_json[$i][$j]['shop'];//第$i个街区第$j个建筑的商店信息
                        $shop_down_num[$i][$x]=count($shop_down[$i][$x]);  //第$i个街区第$j个建筑的商店数量
                        for ($h=0; $h < $shop_down_num[$i][$x]; $h++) { 
                            $shop_type_shop_dm_down[$i][$x][$h]=$content_json[$i][$j]['shop'][$h]['shop_dm'];
                            $shop_type_down[$i][$x][$h]=$content_json[$i][$j]['shop'][$h]['type'];
                            $shop_type_mc_down[$i][$x][$h]=$content_json[$i][$j]['shop'][$h]['type_mc'];
                            //var_dump($shop_type_down[$i][$x][$h]);
                        }
                    }
                    //echo "$direction_up_num[$i]+";
                    
                }
               //echo "$direction_up_num[$i]+$direction_down_num[$i]";     
            }
            //var_dump($content[1]);
               
           $b=intval($a)-1;

           if($a<10){
             $stn=$street_dm."0".$a;
           }
           else $stn=$street_dm.$a;
        
        ?>
        
            <div  width="100%" <?php echo "id=contair$a"  ?> class="contair">
                
                <div class="cont" > 

                   <?php
                   
                       for ($k=0; $k < $direction_up_num[$b]; $k++) {//var_dump($space_up[0][1]);
                            $space_up_data = $space_up[$b][$k] ; //var_dump($space_up);
                            $building_type_up_data=$building_type_up[$b][$k];
                            $location_up_data=$location_up[$b][$k];
                            $building_mc_up_data=$building_mc_up[$b][$k];//var_dump($shop_type_up[0][0][0]);
                                      
                            if($space_up_data=='1'){
                                $space_img[$b]="space_img/3.jpeg";
                            }
                            else if($space_up_data=='2'){
                                $space_img[$b]="space_img/gc.jpeg";
                            }
                            else if($space_up_data=='3'){
                                $space_img[$b]="space_img/2.jpeg";
                            }
                            else if($space_up_data=='4'){
                                $space_img[$b]="space_img/lh.jpeg";
                            }
                            else if($space_up_data=='5'){
                                $space_img[$b]="space_img/kd.jpeg";
                            }
                            
                            echo "<div class='tableb'>";
                            if($building_type_up_data=='31') {
                                echo "<div class='t3'></div>";
                            }
                            elseif($building_type_up_data=='20'||$building_type_up_data=='21') {//判断是否为路口

                                $street_direction_data=$street_direction[$b];
                                $direction_data=$direction_up[$b][$k];
                                //$street_mc_data = $street_mc[$b];

                                $street_dm_click=substr($location_up_data,0,strlen($location_up_data)-2);
                                $street_cmd=substr($location_up_data,strlen($location_up_data)-2,strlen($location_up_data));
                                if ($street_cmd<10) {
                                    $street_cmd=str_replace(0,'',$street_cmd);
                                }
                                $roadsrc='index'.'.php'.'?street='.$street_dm_click.'&n_c='.$street_cmd.'&street_direction_data='.$street_direction_data.'&direction_data='.$direction_data;
                               // var_dump($street_dm_click);
                                //var_dump($street_dm_click);
                                //$roadsrc='index'.'.php'.'?street='.$street_dm_click;
                                echo "<div class='t3 $location_up_data'>";
                                //var_dump($building_mc_up_data);
                                    echo "<a href= $roadsrc><img src='building_photos/lu.jpeg' width='100px' class='img3'/><div class = 'road-name'>$building_mc_up_data</div></a>"; 
                                echo "</div>";  
                            }
                            elseif($location_up_data=="3"){
                                echo "<div class='t2'>
                                    <div class='build_label'>";
                                    //var_dump($shop_up_num[$b][$k]);
                                      for ($l=0; $l < $shop_up_num[$b][$k]; $l++) { 
                                          $shop_type_up_data=$shop_type_up[$b][$k][$l];
                                          $shop_type_mc_data=$shop_type_mc_up[$b][$k][$l];
                                          $shop_type_shop_dm_data=$shop_type_shop_dm[$b][$k][$l];
                                          $shopimg1="shop_img/".$shop_type_up_data.".png";//商店图标路径
                                          if($building_type_up_data=='1'||$building_type_up_data=='10'||$building_type_up_data=='11'||$building_type_up_data=='12'||$building_type_up_data=='13'||$building_type_up_data=='14') {
                                            echo "<div class='shopblock' title =$building_mc_up_data ><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示
                                          }
                                          else{
                                              echo "<div class='shopblock'><span class='font'>$shop_type_mc_data</span><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示
                                              echo "<div class='shop-wrap'>";
                                              include "page/shop.php";
                                              echo "</div>";
                                          }
                                      } 
                                    if($building_type_up_data!='1'&&$building_type_up_data!='10'&&$building_type_up_data!='11'&&$building_type_up_data!='12'&&$building_type_up_data!='13'&&$building_type_up_data!='14') {
                                        echo "<span class='build_name'>$building_mc_up_data</span>";
                                    }
                                    echo "</div></div>"; 
                                    echo "<div class='t1'></div>"; 
                                    echo "<div class='t1'></div>";       
                                // echo "<div class='t1' style='background-image:url($space_img[$b]);background-size: 100% 100%;'></div>"; 
                                // echo "<div class='t1' style='background-image:url($space_img[$b]);background-size: 100% 100%;'></div>"; 
                            }
                            elseif($location_up_data=="2"){ 
                                echo "<div class='t1'></div>"; 
                                echo "<div class='t2'>
                                          <div class='build_label' >";
                                                  //var_dump($shop_type_up[$b][$k]);
                                              for ($l=0; $l < $shop_up_num[$b][$k]; $l++) { 
                                                  $shop_type_up_data=$shop_type_up[$b][$k][$l];
                                                  $shop_type_mc_data=$shop_type_mc_up[$b][$k][$l];
                                                  $shop_type_shop_dm_data=$shop_type_shop_dm[$b][$k][$l];
                                                  $shopimg1="shop_img/".$shop_type_up_data.".png";//商店图标路径

                                                  if($building_type_up_data=='1'||$building_type_up_data=='10'||$building_type_up_data=='11'||$building_type_up_data=='12'||$building_type_up_data=='13'||$building_type_up_data=='14') {
                                                    echo "<div class='shopblock' title =$building_mc_up_data ><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示
                                                  }
                                                  else{
                                                      echo "<div class='shopblock'><span class='font'>$shop_type_mc_data</span><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示
                                                      echo "<div class='shop-wrap'>";
                                                        include "page/shop.php";
                                                      echo "</div>";
                                                  }

                                              }
                                              if($building_type_up_data!='1'&&$building_type_up_data!='10'&&$building_type_up_data!='11'&&$building_type_up_data!='12'&&$building_type_up_data!='13'&&$building_type_up_data!='14') {
                                                    echo "<span class='build_name'>$building_mc_up_data</span>";
                                                } 
                                     echo "</div></div>";
                                     echo "<div class='t1'></div>"; 
                                // echo "<div class='t1' style='background-image:url($space_img[$b]);background-size: 100% 100%;'></div>"; 
                            }
                            elseif($location_up_data=="1"){  
                                echo "<div class='t1'></div>"; 
                                echo "<div class='t1'></div>"; 
                                 echo "<div class='t2'>
                                          <div class='build_label'>";
                                          //var_dump($shop_up_num[$b][$k]);
                                              for ($l=0; $l < $shop_up_num[$b][$k]; $l++) { 
                                                  $shop_type_up_data=$shop_type_up[$b][$k][$l];
                                                  $shop_type_mc_data=$shop_type_mc_up[$b][$k][$l];
                                                  $shop_type_shop_dm_data=$shop_type_shop_dm[$b][$k][$l];
                                                  $shopimg1="shop_img/".$shop_type_up_data.".png";//商店图标路径
                                                  if($building_type_up_data=='1'||$building_type_up_data=='10'||$building_type_up_data=='11'||$building_type_up_data=='12'||$building_type_up_data=='13'||$building_type_up_data=='14') {
                                                    echo "<div class='shopblock' title =$building_mc_up_data ><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示
                                                  }
                                                  else{
                                                      echo "<div class='shopblock'><span class='font'>$shop_type_mc_data</span><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示

                                                      echo "<div class='shop-wrap'>";
                                                        include "page/shop.php";
                                                        echo "</div>";
                                                    }

                                              } 
                                              if($building_type_up_data!='1'&&$building_type_up_data!='10'&&$building_type_up_data!='11'&&$building_type_up_data!='12'&&$building_type_up_data!='13'&&$building_type_up_data!='14') {
                                                    echo "<span class='build_name'>$building_mc_up_data</span>";
                                                }
                                     echo "</div></div>";
                            }
                            echo "</div>";   
                                       
                        
                            //每个building之间的空地
                            
                            echo "<div class='space'></div>";
                        }
                    ?>  

                </div>
                <div class="cont1"><!--道路-->
                    <div name="table4" id="table4" border="0" width="100%">
                       <div class="img1">
                       <?php 
                            //判断街道走向
                            if ($street_direction[$b]==0||$street_direction[$b]==2||$street_direction[$b]==4) {
                                $before="西";
                                $after="东";
                            }
                            elseif ($street_direction[$b]==1||$street_direction[$b]==3||$street_direction[$b]==5) {
                                $before="北";
                                $after="南";
                            }
                        ?>
                           <span class="waydirl"><?php echo "$before"; ?></span>
                           <span class="speedmax"><?php echo "$street_speed"; ?></span><!--街道限速-->
                           <span class="waydirr"><?php echo "$after"; ?></span>
                       </div>
                    </div>
                </div>

                <div class="cont" >   
                      
                       <?php
                       $shop_n2=0;
                           for ($k=0; $k < $direction_down_num[$b]; $k++) {//var_dump($space_up[0][1]);
                                $space_down_data = $space_down[$b][$k] ; //var_dump($space_up);
                                $building_type_down_data=$building_type_down[$b][$k];
                                $location_down_data=$location_down[$b][$k];
                                $building_mc_down_data=$building_mc_down[$b][$k];//var_dump($shop_type_up[0][0][0]);
                                         
                                if($space_down_data=='1'){
                                    $space_img[$b]="space_img/3.jpeg";
                                }
                                else if($space_down_data=='2'){
                                    $space_img[$b]="space_img/gc.jpeg";
                                }
                                else if($space_down_data=='3'){
                                    $space_img[$b]="space_img/2.jpeg";
                                }
                                else if($space_down_data=='4'){
                                    $space_img[$b]="space_img/lh.jpeg";
                                }
                                else if($space_down_data=='5'){
                                    $space_img[$b]="space_img/kd.jpeg";
                                }

                                echo "<div class='tableb'>";

                                if($building_type_down_data=='31') {
                                    echo "<div class='t3'></div>";
                                }
                                elseif($building_type_down_data=='20'||$building_type_down_data=='21') {$street_direction_data=$street_direction[$b];
                                    $direction_data=$direction_up[$b][$k];
                                    $street_dm_click=substr($location_down_data,0,strlen($location_down_data)-2);
                                    $street_cmd=substr($location_down_data,strlen($location_down_data)-2,strlen($location_down_data));
                                    if ($street_cmd<10) {
                                        $street_cmd=str_replace(0,'',$street_cmd);
                                    }
                                    //$roadsrc='index'.'.php'.'?street='.$street_dm_click.'&n_c='.$street_cmd;
                                    $roadsrc='index'.'.php'.'?street='.$street_dm_click.'&n_c='.$street_cmd.'&street_direction_data='.$street_direction_data.'&direction_data='.$direction_data;
                                    //$roadsrc='index'.'.php'.'?street='.$street_dm_click;
                                    echo "<div class='t3 $location_down_data'>";
                                        echo "<a href= $roadsrc><img src='building_photos/lu.jpeg' width='100px' class='img3'/><div class = 'road-name'>$building_mc_down_data</div></a>"; 
                                    echo "</div>";
                                    
                                }
                                elseif($location_down_data=="1"){
                                    echo "<div class='t2'>
                                              <div class='build_label'>";
                                              
                                                  for ($l=0; $l < $shop_down_num[$b][$k]; $l++) { 
                                                      $shop_type_down_data=$shop_type_down[$b][$k][$l];
                                                      $shop_type_mc_data=$shop_type_mc_down[$b][$k][$l];
                                                      $shop_type_shop_dm_data=$shop_type_shop_dm_down[$b][$k][$l];
                                                      $shopimg1="shop_img/".$shop_type_down_data.".png";//商店图标路径
                                                       //var_dump($shop_type_mc_data);
                                                      if($building_type_down_data=='1'||$building_type_down_data=='10'||$building_type_down_data=='11'||$building_type_down_data=='12'||$building_type_down_data=='13'||$building_type_down_data=='14') {
                                                        echo "<div class='shopblock' title =$building_mc_down_data ><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示
                                                      }
                                                      else{
                                                           echo "<div class='shopblock'><span class='font'>$shop_type_mc_data</span><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示

                                                           echo "<div class='shop-wrap'>";
                                                            include "page/shop.php";
                                                            echo "</div>";
                                                        }

                                                  } 
                                                  if($building_type_down_data!='1'&&$building_type_down_data!='10'&&$building_type_down_data!='11'&&$building_type_down_data!='12'&&$building_type_down_data!='13'&&$building_type_down_data!='14') {
                                                      echo "<span class='build_name'>$building_mc_down_data</span>";
                                                  }
                                         echo "</div></div>";       
                                    echo "<div class='t1'><div></div></div>"; 
                                    echo "<div class='t1'><div></div></div>";
                                }
                                elseif($location_down_data=="2"){ 
                                    echo "<div class='t1'></div>"; 
                                    // echo "<div class='t1' style='background-image:url($space_img[$b]);background-size: 100% 100%;'><div></div></div>"; 
                                    echo "<div class='t2'>
                                              <div class='build_label'>";

                                                  for ($l=0; $l < $shop_down_num[$b][$k]; $l++) { 
                                                      $shop_type_down_data=$shop_type_down[$b][$k][$l];
                                                      $shop_type_mc_data=$shop_type_mc_down[$b][$k][$l];
                                                      $shop_type_shop_dm_data=$shop_type_shop_dm_down[$b][$k][$l];
                                                      $shopimg1="shop_img/".$shop_type_down_data.".png";//商店图标路径

                                                      if($building_type_down_data=='1'||$building_type_down_data=='10'||$building_type_down_data=='11'||$building_type_down_data=='12'||$building_type_down_data=='13'||$building_type_down_data=='14') {
                                                        echo "<div class='shopblock' title =$building_mc_down_data ><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示
                                                      }
                                                      else{
                                                          echo "<div class='shopblock'><span class='font'>$shop_type_mc_data</span><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示

                                                          echo "<div class='shop-wrap'>";
                                                        include "page/shop.php";
                                                        echo "</div>";
                                                      }

                                                  } 
                                                  if($building_type_down_data!='1'&&$building_type_down_data!='10'&&$building_type_down_data!='11'&&$building_type_down_data!='12'&&$building_type_down_data!='13'&&$building_type_down_data!='14') {
                                                      echo "<span class='build_name'>$building_mc_down_data</span>";
                                                  }
                                         echo "</div></div>";
                                    echo "<div class='t1'><div></div></div>"; 
                                }
                                elseif($location_down_data=="3"){  
                                    echo "<div class='t1'></div>"; 
                                    echo "<div class='t1'></div>"; 
                                    // echo "<div class='t1' style='background-image:url($space_img[$b]);background-size: 100% 100%;'><div></div></div>"; 
                                    // echo "<div class='t1' style='background-image:url($space_img[$b]);background-size: 100% 100%;'><div></div></div>";  
                                     echo "<div class='t2'>
                                              <div class='build_label'>";

                                                  for ($l=0; $l < $shop_down_num[$b][$k]; $l++) { 
                                                      $shop_type_down_data=$shop_type_down[$b][$k][$l];
                                                      $shop_type_mc_data=$shop_type_mc_down[$b][$k][$l];
                                                      $shop_type_shop_dm_data=$shop_type_shop_dm_down[$b][$k][$l];
                                                      $shopimg1="shop_img/".$shop_type_down_data.".png";//商店图标路径
                                                      //var_dump($shopimg1);
                                                      if($building_type_down_data=='1'||$building_type_down_data=='10'||$building_type_down_data=='11'||$building_type_down_data=='12'||$building_type_down_data=='13'||$building_type_down_data=='14') {
                                                        echo "<div class='shopblock' title =$building_mc_down_data ><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示
                                                      }
                                                      else{
                                                          echo "<div class='shopblock'><span class='font'>$shop_type_mc_data</span><img class='imglabel' src=$shopimg1 width='50px' height='50px'/></div>";//店铺图标显示

                                                          echo "<div class='shop-wrap'>";
                                                        include "page/shop.php";
                                                        echo "</div>";
                                                    }

                                                  } 
                                                  if($building_type_down_data!='1'&&$building_type_down_data!='10'&&$building_type_down_data!='11'&&$building_type_down_data!='12'&&$building_type_down_data!='13'&&$building_type_down_data!='14') {
                                                      echo "<span class='build_name'>$building_mc_down_data</span>";
                                                  }
                                         echo "</div></div>";
                                }
                         
                                echo "</div>";   
                            
                            echo "<div class='space'></div>";           
                            }
                        ?>             
                      
                   </div> 
                </div>
            </div>
       </div>
   </div>
   <div id="nav">
        <div class="lin">
            <div id="timeline">
                <div class="inside"  id="mycanvs" style="cursor:pointer" onmousedown="getzb(event)">
                   <img src="images/inside.png" />
                </div>
               <div id="xycoordinates"></div>
            </div>
            <ul class="navli">
            <?php
               for ($i=0; $i <$street_num ; $i++) { 
                    $street_arry=$select_data[$i];
                    $j=$i+1;
                    //$midsrc='index'.'.php'.'?n_c='.$j;
                    $p="p".$j;
                    $a="a".$j;
                    $street_mc_data=$street_arry['street_mc'];

                  echo "<li class=$p><span class='xian'><b>|</b></span><span class='bz'><a id='progressbar' class=$a>$street_mc_data</a></span></li>";
               }
            ?>
               </ul>
        </div>
   </div>
</div>
<div id="bottom">
</div>
<?php mysql_close($link); ?>
<script type="text/javascript">
    bindevent();  
</script>
</body>
</html>
