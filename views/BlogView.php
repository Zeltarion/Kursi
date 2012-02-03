<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<?php
 require_once('views/blog/View_blog_head.html');
?>
<body>
<?php
  require_once('views/blog/View_blog_first_menu.php');
  require_once('views/blog/View_blog_header.html');

 if(!empty($_GET['content']))
 {
  switch($_GET['content'])
  {
   case 'create_post':require_once('views/blog/View_form_create_post.html');
   break;
   case 'create_blog':require_once('views/blog/View_form_create_blog.html');
   break;
  }
 }
 if(!empty($_GET['tag_name']))
 {
     $post_array = array();
     $post_array = $tf->Posts->posts_blog($_GET['tag_name'],$_GET['id_blog']);
     $tag_mas = $tf->Tags->list_tag($post_array[0]);

     $col_post = sizeof($post_array[0]);

     for($i=0;$i<$col_post;$i++)
     {
         echo '<b>'.$post_array[1][$i].'</b> &nbsp;'.$post_array[4][$i].'<br/>'. $post_array[2][$i].'<br/>';
         echo '<b>Теги:</b> &nbsp;';
         for($j=0;$j<sizeof($tag_mas[$i][$j]);$j++)
         {
             echo '<a href=\'index.php?tag_name='.$tag_mas[$i][$j].'\'>'.$tag_mas[$i][$j].'</a>';
         }
     }
 }
 else
 {
     $post_array = array();
     $post_array = $tf->Posts->all_posts();
     $tag_mas = $tf->Tags->list_tag($post_array[0]);
     $col_post = sizeof($post_array[0]);

     for($i=0;$i<$col_post;$i++)
     {
         echo '<b>'.$post_array[1][$i].'</b> &nbsp;'.$post_array[4][$i].'<br/>'. $post_array[2][$i].'<br/>';
         echo '<b>Теги:</b> &nbsp;';
         for($j=0;$j<sizeof($tag_mas[$i][$j]);$j++)
         {
             echo '<a href=\'index.php?tag_name='.$tag_mas[$i][$j].'&id_blog='.$id_blog.'\'>'.$tag_mas[$i][$j].'</a>';
         }
     }
 }

  if(!empty($_POST['submit_create_blog']))
  {
      //ЗАНЕСЕНИЕ ДАННЫХ БЛОГА В БД
      $date = date("Y-m-d H:i:s");
      $id_users = $tf->Users->id_users();
      $tf->Blogs->insert(array('id_user'=>$id_users,'name'=>$_POST['name_blog'],'description'=>$_POST['description'],'date'=>$date));
  }

  if(!empty($_POST['submit_create_post']))
  {
     /* ЗАНЕСЕНИЕ В БД ДАННЫХ ПОСТА
       занести данные поста в таблицу posts, выбрать id поста и занести в переменную $id_post;
       занести все теги поста в таблицу tags,выбрать id тега и занести $id_record_tag;
       занести id тега в таблицу posts_tags;
       update таблицы posts_tags. Внести id поста в id_post таблицы posts_tags где id тега = $id_record_tag[$i]
     */
     $id_record_post = $tf->Posts->insert(array('name'=>$_POST['name_post'],'text'=>$_POST['text_post'],'path_image'=>$_POST['path_file_image_post']));

   If(!empty($_POST['input_tags']))
   {
    $tag_mas = explode(",",$_POST['input_tags']);
    $tag_mas = array_map('trim', $tag_mas);
    $length_tag_mas = sizeof($tag_mas);
    for($i=0;$i<$length_tag_mas;$i++)
    {
        $id_record_tag = $tf->Tags->insert(array('name'=>$tag_mas[$i]));
        $tf->Posts_tags->update(array('id_post'=>$id_record_post),array('id_tag'=>$id_record_tag));
    }
   }
  }

  if(!empty($_GET['id_post']))
  { // УДАЛЕНИЕ ДАННЫХ ПОСТА ИЗ БД
    $id_tags = array();
    $id_tags = $tf->Posts_tags->id_tags($id_post);
    $tf->Posts->delete($id_post);
    $tf->Posts_tags->delete($id_post);
    $tf->Tags->delete($id_tags);
  }

  if(!empty($_POST['submit_select_blog']))
  {
    //вывести все посты пользователя
    if(!empty($_GET['tag_name']) && !empty($_GET['id_blog']))
    {
      $post_array = array();
      $post_array = $tf->Posts->posts_blog($_GET['tag_name'],$_GET['id_blog']);
      $tag_mas = $tf->Tags->list_tag($post_array[0]);

      $col_post = sizeof($post_array[0]);

      for($i=0;$i<$col_post;$i++)
      {
        echo '<b>'.$post_array[1][$i].'</b> &nbsp;'.$post_array[4][$i].'<br/>'. $post_array[2][$i].'<br/>';
        echo '<b>Теги:</b> &nbsp;';
        for($j=0;$j<sizeof($tag_mas[$i][$j]);$j++)
        {
         echo '<a href=\'index.php?tag_name='.$tag_mas[$i][$j].'&id_blog='.$id_blog.'\'>'.$tag_mas[$i][$j].'</a>';
        }
      }
    }
    else
    {
        $post_array = array();
        $tag_mas = array();
        $id_blog = $tf->Blogs->blog_content($_POST['select_name_blog'],$users->id_users());
        $post_array = $tf->Posts->list_post($id_blog);
        $tag_mas = $tf->Tags->list_tag($post_array[0]);

        $col_post = sizeof($post_array[0]);

        for($i=0;$i<$col_post;$i++)
        {
            echo '<b>'.$post_array[1][$i].'</b> &nbsp;'.$post_array[4][$i].'<br/>'. $post_array[2][$i].'<br/>';
            echo '<b>Теги:</b> &nbsp;';
            for($j=0;$j<sizeof($tag_mas[$i][$j]);$j++)
            {
                echo '<a href=\'index.php?tag_name='.$tag_mas[$i][$j].'&id_blog='.$id_blog.'\'>'.$tag_mas[$i][$j].'</a>';
            }
        }
    }

  }

  unset($post_array);
  unset($id_blog);
  unset($tag_mas);

  unset($_GET['tag_name']);
  unset($_GET['id_blog']);
  unset($_GET['content']);
  unset($_POST['input_tags']);
  unset($_POST['submit_create_post']);
  unset($_POST['submit_create_blog']);
  require_once('views/blog/View_blog_footer.html');
 ?>
</body>
</html>