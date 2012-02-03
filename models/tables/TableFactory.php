<?php
class TableFactory 
{
    private $db;
    private $PathToTable;
    private $PathToDatabase;
    private $object = array();
       
    public function __construct($db, $PathTo)
    {
        $this->db = $db;
        $this->PathToDatabase = $PathTo . 'database/';
        $this->PathToTable = $PathTo . 'tables/';
    }

    public function __get($ClassName)
    {
        return $this->getTable($ClassName);
    }


    private function existsIncludeFile($nameFile, $Path)
    {
        if (file_exists($Path . $nameFile))
            {
                require_once $Path . $nameFile;
            }
            else
            {
                throw new Exception('Не найден файл ' . $Path . $nameFile);
            }
    }

    private function getTable($ClassName)
    {
        if (isset($this->db) && !empty($this->db))
        {
          $this->existsIncludeFile('TableGateway.php', $this->PathToTable);
          $this->existsIncludeFile($ClassName . '.php', $this->PathToTable);
          //$this->existsIncludeFile('SQLSpecification.php', $this->PathToTable);
          if (!array_key_exists($ClassName, $this->object))
          {
            $this->object[$ClassName] = new $ClassName();
            $this->object[$ClassName]->SetDb($this->db);
          }
         return $this->object[$ClassName];
        }
        else
        {
            echo 'Не создан объект БД';
            exit;
        }
    }
}
 
?>
