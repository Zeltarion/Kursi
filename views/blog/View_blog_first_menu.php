<?php
$list_blog = array();
$list_blog = $blogs->list_blog($users->id_users());
//var_dump($list_blog);
?>

<div id="first_menu">
 <?php
 if(!empty($_POST['submit_select_blog']))
 {
 ?>
  <a href='../controllers/Controller_blog.php?content=create_post'>Создать пост</a>
 <?php
 }
 ?>
 <a href='../controllers/Controller_blog.php?content=create_blog'>Создать блог</a>
<!-- <a href=''>Создать пост</a>-->
    <form action="../controllers/Controller_blog.php">
        <label>
            Войти в блог
            <select value='select_name_blog'>
              <?php
               if(count($list_blog)!=0)
               {
                for($i=0;count($list_blog)-1;$i++)
                {
              ?>
                 <option>
                  <?php $list_blog[$i];?>
                 </option>
              <?php
                }
               }
              ?>
        </label>
       <input type="submit" value="выбрать" name="submit_select_blog"/>
    </form>
</div>
