<?php
   define("HOST", "localhost");
   define("USER", "root");
   define("PASS", "root");
   define("DBNAME", "dxstreet");
   $link=mysql_connect(HOST,USER,PASS)or die("连接失败".mysql_error()); 
   $linkdb=mysql_select_db(DBNAME,$link)or die('连接数据库失败'.mysql_error());
   mysql_set_charset($link,"utf8");
   mysql_query("set names 'utf8' "); 
?>