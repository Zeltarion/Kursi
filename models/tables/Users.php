<?php
class Users extends TableGateway
{
    public function __construct()
    {
        parent::__construct('users');
    }

    public function id_users()
    {
        $login = $_SESSION['login'];
        $Sql = 'SELECT id_user FROM users WHERE login = \''.$login.'\'';
        $rez = $this->db->query($Sql);
        $id_user = $this->db->fetch_array($rez);
        return intval($id_user['id_user']);
    }
}
?>
