<?php
	session_start();
	$_SESSION = array();
	if(isset($_COOKIE[session_name()]))
	{
		setCookie(session_name(),'',time()-3600,'/');
	}
	session_unset();			//清空session
  	session_destroy();			//删除session文件
  	if (isset($_SESSION)) {
    	unset($_SESSION);	//注销$_SESSION
    }
	session_destroy();
	header('Location:../search.php');
?>