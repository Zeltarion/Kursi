<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <?php require_once("index/View_index_head.html");?>
<body>
<?php
require_once("index/View_index_header.html");
require_once("index/View_index_content.php");
require_once("index/View_index_footer.html");
unset($_SESSION["message"]);
unset($_SESSION["reg_message"]);
?>
</body>
</html>
