<div id="content">
  <div class="h-page">
   <div class="layout-wrapper">	 
    <div>
		<?
		 echo $_SESSION['message']."\n".$_SESSION['reg_message'];
		?>
    </div>	  
    <div class="b-login-form b-login-form-main">	 
     <h2 class="header">Вход</h2>
     <form id="auth" method="post" action="models/Model_authorization.php">
	  <p>	
	   <input id="auth-login" class="tx inactive" type="text" value="email" name="email"/>
	   <div id="validEmail"></div>
       <input id="auth-pass-txt" class="tx inactive" type="password" value="Пароль" name="password"/>
       <input class="im" type="submit" value="Войти"  name="authorize"/>
	  </p>
	 </form>
	 <p>
      <a class="link-color" href="">Забыли пароль?</a>
      &nbsp;•&nbsp;
      <a class="link-color" href="">Регистрация</a>
     </p>
    </div>
    
   </div>
  </div> 
 </div>
