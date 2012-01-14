<?php
/*
$mysql_host = "mysql6.000webhost.com";
$mysql_database = "a3730881_SASG";
$mysql_user = "a3730881_root";
$mysql_password = "115732zeltarion";
*/
/*
$db = mysql_connect ("a3730881_SASG","a3730881_root","115732zeltarion");
mysql_select_db ("mysql",$db); 
 */
 // Соединямся с БД 
    $host = "localhost";
    $user = "root";
    $pasw = "1234";
    $dbname = "SASG";
  if (!($db = mysql_connect($host,$user,$pasw)))
	{
	echo "Ошибка подключения к серверу MySQL";
    exit;
	}
    mysql_select_db($dbname);
    mysql_query("set character set cp1251;");
?>
