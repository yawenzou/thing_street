
<?php
//搜索页面的模糊查询
	require("dbconfig.php");
	$sertext=$_POST['sertexta'];
	$place=$_POST['place'];
	// $place="杭州";
	// $sertext='学林 高沙 工商   ';
	$sertext_arr=explode(" ",$sertext);
	$sertext_arr_num=count($sertext_arr);
	$selt_city=mysql_query("select * from d_city where city_mc like '$place%'");
	$city_result=mysql_fetch_assoc($selt_city);
	$city_id=$city_result['city_dm'];
	$city_id_data=substr($city_id,0,4);
	//var_dump($city_id_data);
	$n=0;
if($city_id_data){
	for ($j=0; $j < $sertext_arr_num; $j++) { //分别匹配每个搜索词
		if ($sertext_arr[$j]=='') {
			continue;
		}
		else {
			$select_street=mysql_query("select * from street where street_mc like '%$sertext_arr[$j]%' and street_dm like '$city_id_data%'")or die(mysql_error());
			$select_building=mysql_query("select * from building where building_mc like '%$sertext_arr[$j]%' and building_dm like '$city_id_data%'")or die(mysql_error());
			$select_shop=mysql_query("select * from shop where shop_mc like '%$sertext_arr[$j]%' and shop_dm like '$city_id_data%'")or die(mysql_error());
			$num1=mysql_num_rows($select_street);
			$num2=mysql_num_rows($select_building);
			$num3=mysql_num_rows($select_shop);
			for ($i=0; $i < $num1; $i++) { //搜索匹配街道
				$street_result=mysql_fetch_assoc($select_street);
				//var_dump($streetresult['street_dm']);
				$street_base=$street_result['street_dm'].",".intval($street_result['street_cdm'],10).',';
				echo "$street_base";
				$city_dm=substr($street_result['street_dm'],0,6);
				$select_city=mysql_query("select * from d_city where city_dm='$city_dm'");
				$city_result=mysql_fetch_assoc($select_city);
				$ser_base=$city_result['city_mc'].$street_result['street_mc'].";";
				echo "$ser_base";
			}
			for ($i=0; $i < $num2; $i++) { //搜索匹配建筑
				$building_result=mysql_fetch_assoc($select_building);
				$building_street_dm=$building_result['street_dm'];
				$street_dm=substr($building_street_dm,0,10);
				$street_cdm=substr($building_street_dm,10,2);
				$street_base=$street_dm.",".intval($street_cdm,10).',';
				echo "$street_base";
				$city_dm=substr($street_dm,0,6);
				$select_city=mysql_query("select * from d_city where city_dm='$city_dm'");
				$select_street=mysql_query("select * from street where street_dm='$street_dm' and street_cdm='$street_cdm'");
				$city_result=mysql_fetch_assoc($select_city);
				$street_result=mysql_fetch_assoc($select_street);
				$ser_base=$city_result['city_mc'].$street_result['street_mc'].$building_result['building_mc'].";";
				echo "$ser_base";
			}
			for ($i=0; $i < $num3; $i++) { //搜索匹配商铺
				$shop_result=mysql_fetch_assoc($select_shop);
				$shop_building=$shop_result['building'];
				$shop_mc=$shop_result['shop_mc'];
				$street_dm=substr($shop_building,0,10);
				$street_cdm=substr($shop_building,10,2);
				$street_base=$street_dm.",".intval($street_cdm,10).',';
				echo "$street_base";
				$city_dm=substr($street_dm,0,6);
				$select_city=mysql_query("select * from d_city where city_dm='$city_dm'");
				$select_street=mysql_query("select * from street where street_dm='$street_dm' and street_cdm='$street_cdm'");
				$select_building=mysql_query("select * from building where building_dm='$shop_building'");
				$city_result=mysql_fetch_assoc($select_city);
				$street_result=mysql_fetch_assoc($select_street);
				$building_result=mysql_fetch_assoc($select_building);
				$ser_base=$city_result['city_mc'].$street_result['street_mc'].$building_result['building_mc'].$shop_mc.";";
				echo "$ser_base";
			}
			$n=$n+$num1+$num2+$num3;
	    }
	}
}
	echo "$n";		
?>