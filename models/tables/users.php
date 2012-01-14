<?php
class Users extends TableGateway
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
        parent::__construct($db,'users');
    }

    public function id_users()
    {
        $login = $_SESSION['login'];
        $Sql = 'SELECT id_user FROM users WHERE login = \''.$login.'\'';
        $rez = $this->db->query($Sql);
        $id_user = mysql_fetch_assoc($rez);
        return intval($id_user['id_user']);
    }
}
?>
