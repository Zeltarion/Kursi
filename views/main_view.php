<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

 <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
    <script type="text/javascript" src="public/js/jquery.js"></script>
    <script type="text/javascript" src="public/js/index_script.js"></script>
    <script type="text/javascript" src="public/js/verifying_email.js"></script>
    <link rel="stylesheet" type="text/css" href="public/css/Style.css"/>
    <style type="text/css">
    </style>
 </head>

 <body>
 <?php if(isset($first_menu)) {echo $first_menu;} ?>
 <div id="header">
     <div class="menu clear">
         <a class="logo" href="/"></a>
         <ul class="menu-options">
             <li>
                 <a href="">Главная</a>
             </li>
             <li>
                 <a href="?cntr=Blog&action=SelectBlog">Блог</a>
             </li>
             <li>
                 <a href="">Контакты</a>
             </li>
             <li>
                 <a href="controllers/Controller_registration.php">Регистрация</a>
             </li>
             <li>
                 <a href="">Вход</a>
             </li>
         </ul>
     </div>
 </div>

 <div class="footer">
     <a href="">Контакты</a>
     |
     <a href="?cntr=Blog&action=SelectBlog">Блог</a>
     |
     <a href="">Помощь</a>
     © 2011
     </br>
 </div>

 </body>
</html>