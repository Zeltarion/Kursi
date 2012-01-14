<?php
session_start();
require_once('../models/database/Database.php');
require_once('../models/database/MySqlDb.php');
require_once('../models/config/ConfigDb.php');

$db = new MySqlDb(array(DB_HOST, DB_USER, DB_PASS, DB_NAME));
$db->connectDb();
$Sql = "SELECT login ,email, password FROM users WHERE email='".$_POST['email']."' LIMIT 1";
$rez = $db->query($Sql);
$data = mysql_fetch_assoc($rez);
 $password = strrev(md5($_POST['password']))."b3p6f";
 if( ($_POST['email']== $data['email']) && ( $password == $data['password']) )
 {
  $_SESSION['reg_message']='Приветствую!)';	 
  $_SESSION['authorized']=1;
  $_SESSION['login']= $data['login'];
 } 
 header("Location: ../index.php");
?>
