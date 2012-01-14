<?php
class Tags extends TableGateway
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
        parent::__construct($db,'tags');
    }

    public function list_tag($id_post)
    {
        $blog_arr = array();
        $condition = '';
        $name_tag = array();
       if(sizeof($id_post)>1)
       {
        for($i=1;$i<=sizeof($id_post)-1;$i++)
        {
            $condition.= 'OR '.$id_post[$i].'= posts_tags.id_post';
        }
       }
        $Sql = 'SELECT tags.name FROM posts LEFT JOIN posts_tags ON '.$id_post[0].'= posts_tags.id_post'.$condition.
                                          ' LEFT JOIN tags ON posts_tags.id_tag = tags.id_tag';
        $i=0;
        $rez = $this->db->query($Sql);
        while($blog_arr[] = mysql_fetch_array($rez))
        {
            $name_tag[$i][] = $blog_arr['name'];
            $i++;
        }
        return $name_tag;
    }

    public function id_tags($id_post)
    {
      $id_tag = array();
      $blog_arr = array();

      $Sql = 'SELECT id_tag FROM posts_tags WHERE id_post = '.$id_post;
      $rez = $this->db->query($Sql);
      while($blog_arr[] = mysql_fetch_array($rez))
      {
        $id_tag[] = $blog_arr['id_tag'];
      }
      return $id_tag;
    }
}
?>
