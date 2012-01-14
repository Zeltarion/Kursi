<?php

class MySqlDb extends Database
{
 private $connect = array();
 private $mysqlConnect;

 function __construct(array $ArrayDbParams)
 {
  $this->connect = $ArrayDbParams;
 }

 function __destructor()
 {
     return mysql_close($this->mysqlConnect);
 }

 function connectDb()
 {
  try {
       $this->mysqlConnect = mysql_connect($this->connect[0], $this->connect[1], $this->connect[2]);
       if (!$this->mysqlConnect)
       {
         throw new Exception('Невозможно подключиться к бд');
       }
       if (!mysql_select_db($this->connect[3]))
       {
        throw new Exception('Не обнаружило бд');
       }
      }
  catch (Exception $ex)
  {
   echo $ex->getMessage();
   exit;
  }
   return;
 }

 function query($Sql)
 {
     mysql_query('SET NAMES utf8');
  return mysql_query($Sql);
 }

}
?>