<?php
require_once("Model_link_bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
$result4 = mysql_query ("SELECT avatar FROM users WHERE activation='0' AND UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 3600");//извлекаем аватарки тех пользователей, которые в течении часа не активировали свой аккаунт. Следовательно их надо удалить из базы, а так же и файлы их аватарок

if (mysql_num_rows($result4) > 0) {
$myrow4 = mysql_fetch_array($result4);	
do
{
//удаляем аватары в цикле, если они не стандартные
if ($myrow4['avatar'] == "../images/avatars/net-avatara.jpg") {$a = "Ничего не делать";}
else {
	unlink ($myrow4['avatar']);//удаляем файл
	}
}
while($myrow4 = mysql_fetch_array($result4));
}
mysql_query ("DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 3600");//удаляем пользователей из базы



if (isset($_GET['code'])) {$code =$_GET['code']; } //код подтверждения
else
{ exit("Вы зашил на страницу без кода подтверждения!");} //если не указали code, то выдаем ошибку

if (isset($_GET['login'])) {$login=$_GET['login']; } //логин,который нужно активировать
else
{ exit("Вы зашил на страницу без логина!");} //если не указали логин, то выдаем ошибку

$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db); //извлекаем идентификатор пользователя с данным логином
$myrow = mysql_fetch_array($result); 

$activation = md5($myrow['id']).md5($login);//создаем такой же код подтверждения
if ($activation == $code) {//сравниваем полученный из url и сгенерированный код
	mysql_query("UPDATE users SET activation='1' WHERE login='$login'",$db);//если равны, то активируем пользователя
	echo "Ваш Е-мейл подтвержден! Теперь вы можете зайти на сайт под своим логином! <a href='../index.php'>Главная страница</a>";
	}
else {echo "Ошибка! Ваш Е-мейл не подтвержден! <a href='index.php'>Главная страница</a>";
//если же полученный из url и сгенерированный код не равны, то выдаем ошибку
}

?>
