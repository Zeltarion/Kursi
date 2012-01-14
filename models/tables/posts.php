<?php
class Posts extends TableGateway
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
        parent::__construct($db,'posts');
    }

    public function all_posts()
    {
        $id_post = array();
        $name_post = array();
        $text_post = array();
        $path_image_post = array();
        $date_post = array();
        $blog_arr = array();

        $Sql = 'SELECT id_post, name, text, path_image, date FROM posts ORDER BY date DESC';
        $rez = $this->db->query($Sql);
        while($blog_arr[] = mysql_fetch_array($rez))
        {
            $id_post[] = $blog_arr['id_post'];
            $name_post[] = $blog_arr['name'];
            $text_post[] = $blog_arr['text'];
            $path_image_post[] = $blog_arr['path_image'];
            $date_post[] = $blog_arr['date'];
        }
       return array($id_post, $name_post, $text_post, $path_image_post, $date_post);
    }
    public function list_post($id_blog)
    {
        $id_post = array();
        $name_post = array();
        $text_post = array();
        $path_image_post = array();
        $date_post = array();
        $blog_arr = array();

        $Sql = 'SELECT posts.id_post, posts.name, posts.text, posts.path_image, posts.date FROM posts, blogs WHERE id_blog = '.$id_blog;
        $rez = $this->db->query($Sql);
        while($blog_arr[] = mysql_fetch_array($rez))
        {
            $id_post[] = $blog_arr['id_post'];
            $name_post[] = $blog_arr['name'];
            $text_post[] = $blog_arr['text'];
            $path_image_post[] = $blog_arr['path_image'];
            $date_post[] = $blog_arr['date'];
        }
        //return $blog_arr;
        return array($id_post, $name_post, $text_post, $path_image_post, $date_post);
    }

    public function posts_blog($id_tag,$id_blog)
    {
        $id_post = array();
        $name_post = array();
        $text_post = array();
        $path_image_post = array();
        $date_post = array();
        $blog_arr = array();
        $Sql = 'SELECT posts.id_post, posts.name, posts.text, posts.path_image, posts.date FROM posts LEFT JOIN posts_tags ON '.$id_tag.'= posts_tags.id_tag AND posts.id_blog = '.$id_blog.'ORDER BY posts.date DESC';
        $rez = $this->db->query($Sql);
        while($blog_arr[] = mysql_fetch_array($rez))
        {
            $id_post[] = $blog_arr['id_post'];
            $name_post[] = $blog_arr['name'];
            $text_post[] = $blog_arr['text'];
            $path_image_post[] = $blog_arr['path_image'];
            $date_post[] = $blog_arr['date'];
        }
        return array($id_post, $name_post, $text_post, $path_image_post, $date_post);
    }
}
?>
