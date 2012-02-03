<?php

class Blogs extends TableGateway
{

    public function __construct()
    {
        parent::__construct('blogs');
    }
    public function list_blog($id_user)
    {
        $name_blog = array();
        $blog_arr = array();
        //echo $id_user.'<br/>';
        $Sql = 'SELECT name FROM blogs WHERE id_user ='.$id_user;
        $rez = $this->db->query($Sql);
        while($blog_arr = $this->db->fetch_array($rez))
        {
             $name_blog[] = $blog_arr['name'];
        }

       return $name_blog;
    }

    public function id_blog($name_blog)
    {
        $Sql = 'SELECT id_blog FROM blogs, blogs WHERE id_user ='.$name_blog;
        $rez = $this->db->query($Sql);
        $id_blog = $this->db->fetch_array($rez);
        return $id_blog;
    }


    public function blog_content($select_name_blog, $id_user)
    {
         $blog_arr = array();
         $Sql = 'SELECT id_blog FROM users, blogs WHERE id_user = '.$id_user.'AND name = \''.$select_name_blog.'\'';
         $rez = $this->db->query($Sql);
         while($blog_arr[] = $this->db->fetch_array($rez))
         {
            $id_blog = $blog_arr['id_blog'];
         }
        return $id_blog;
    }
}
?>
