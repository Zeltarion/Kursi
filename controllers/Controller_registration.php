<?php
 if(!isset($_POST['submit']))
 {
  require_once("../views/View_registration.html");
 }
 else{
	 require_once("../models/Model_save_user.php"); 
	 }
 unset($_POST['submit']);
?>

