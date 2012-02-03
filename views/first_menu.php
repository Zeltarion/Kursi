<div id="first_menu">
   <?php
    if(!empty($_POST['submit_select_blog'])):
   ?>
        <a href='?cntr=Post&action=CreatePost'>Создать пост</a>
   <?php
    endif;
   ?>
    <a href='?cntr=Blog&action=CreateBlog'>Создать блог</a>
    <!-- <a href=''>Создать пост</a>-->
    <form action="index.php" method='POST'>
        <label>
            Войти в блог
            <select value='select_name_blog'>
               <?php
                if(count($list_blog)!=0):
                    for($i=0;count($list_blog)-1;$i++):
               ?>
                        <option>
                            <?php $list_blog[$i];?>
                        </option>
               <?php
                    endfor;
                endif;
               ?>
        </label>
        <input type="submit" value="Выбрать блог" name="submit_select_blog"/>
    </form>
</div>
