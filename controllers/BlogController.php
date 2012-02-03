<?php
/*
 $view[0] = 'content'; $p[0]= 'данные для content'
$view[1] = 'first_menu'; $p[1]= 'данные для first_menu'
.......................................................
*/
 class BlogController extends Controller
 {
     protected $notificationsList = array();
     private $i;
     public function __construct($tf, $pathToViews) {
        // parent:: __construct($tf, $pathToViews);
         $this->tf = $tf;
         $this->pathToViews = $pathToViews;
     }

     public function render($view, $p)
     {
         require_once($this->getViewName('View'));
         if($p == 'default page')
         {
             $v =  new View($this->getViewName($view));
             return $v->render_view(null);
         }

         $this->i = 0;
         $NameView = array();
         $pMain = array();
         $pMain['notificationsList'] = array();
         $pMain['notificationsList'] = $this->notificationsList;

         if (is_array($view))
         {
            foreach($view as $key=>$value)
            {
              $NameView[] = $value;
              $v = new View($this->getViewName($NameView));
              $pMain[$NameView] = $v->render_view($p[$this->i]);
              $this->i++;
            }
         }
         else
         {
             $v = new View($this->getViewName($view));
             $pMain[$view] = $v->render_view($p);
         }

         $v = new View($this->getViewName('main_view'));
         return $v->render_view($pMain);

       /*  if(!empty($p['first_menu']))
         {
          $pMain['first_menu'] = $v->render_view($p['list_blog']);
         }*/
     }

    /* public function NameView($view)
     {
        $NameView = array();
         foreach($view as $key=>$value)
         {
             if (is_array($view))
             { // Если $a массив, то снова вызываем функцию
              $NameView[] = $value;
             }else{
                 // выполняем действия над значениями массива
             }
         }
       return $NameView;
     }*/

     public function SelectBlog()
     {
         $list_blog = array();
         $p = array();
         $list_blog = $this->tf->Blogs->list_blog($this->tf->Users->id_users());
         $p['first_menu'] = true;
         $p['list_blog'] = $list_blog;
         echo $output = $this->render('first_menu',$p);
     }

     public function CreateBlog()
     {

        // echo $output = $this->render('form_create_blog',$p);

         if(!empty($_POST['submit_create_blog']))
         {
             //ЗАНЕСЕНИЕ ДАННЫХ БЛОГА В БД
             $date = date("Y-m-d H:i:s");
             $id_users = $this->tf->Users->id_users();
             $this->tf->Blogs->insert(array('id_user'=>$id_users,'name'=>$_POST['name_blog'],'description'=>$_POST['description'],'date'=>$date));
         }
     }
 }

?>