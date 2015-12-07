<?php
	require("dbconfig.php");
	$user=trim($_POST['user']);
	$password=trim($_POST['password']);
	//$user="admin";
	//$password="123456";
	$password=md5($password);

	$select_user=mysql_query("select * from user where mail='$user' or nicknames='$user'")or die("选择失败！".mysql_error());
	$result=mysql_fetch_assoc($select_user);

	if(($user==$result['mail']||$user==$result['nicknames']) && $password==$result['password']){
		$act['login'] = true;
		session_start();
		$_SESSION['id'] = $result['id'];
		$_SESSION['name'] = $result['nicknames'];
		$_SESSION['islogin'] = true;
	}
	else{
		$act['login'] = false;
		$act['problem'] = "用户名或密码错误!";
		session_start();
		$_SESSION['islogin'] = false;
	}
	/*if($_POST['rembercode']=='true'){ 
		setcookie('username',$_POST['user'],time()+60); 
		setcookie('password',$_POST['password'],time()+60); 
	} */
	mysql_close();
	echo json_encode($act);
?>