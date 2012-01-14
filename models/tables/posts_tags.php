<?php
class Posts_tags extends TableGateway
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
        parent::__construct($db,'posts_tags');
    }
}
?>
