<?php
 session_start();
try
{
 require_once('config/ConfigDb.php');
 require_once('models/database/Database.php');
 require_once('models/database/MySqlDb.php');
 require_once('models/tables/TableGateway.php');
 require_once('models/tables/TableFactory.php');
 require_once('models/request/Request.php');
 require_once('controllers/Controller.php');
 require_once('controllers/BlogController.php');
 require_once('controllers/FrontControlller.php');

 $db = new MySqlDb(array(DB_HOST, DB_USER, DB_PASS, DB_NAME));
 $db->connectDb();
 $tf = new TableFactory($db, 'models/');

 $r = new Request();
 $fc = new FrontController('controllers/',$tf,'views/');

 $fc->dispatch($r);
}
catch(Exception $ex)
{
    echo $ex->getMessage();
    exit;
}

?>
