<?php

class TableGateway
{
    private $tablename;
    private $database;
    public function __construct($db,$tbname)
    {
        $this->tablename = $tbname;
        $this->database = $db;
    }

    protected function CorrectedValue($value)
    {
        $corrected = gettype($value);
        if (in_array($corrected,array('int','bigint','tinyint','smallint','mediumint')))
        {
            $value=intval($value);
        }
        elseif (in_array($corrected,array('decimal','float','double','real')))
        {
            $value=floatval($value);
        }
        elseif ($corrected=='bool')
        {
            $value=$value;
        }
        else
        {
            $value='\'' .addslashes($value ).'\'' ;
        }
        return $value;
    }

    public function insert($fields)
    {
        $keys = '';
        $val = '';
        $values = '';
        reset($fields);
        $firstKey=key($fields);
        foreach($fields as $name=>$val)
        {
            if ($name <> $firstKey)
            {
                $keys.=',';
                $values.=',';
            }
            $keys.= '`'.$name.'`';
            $values.='\''.addslashes($val).'\'';
        }
        $Sql = 'INSERT INTO `'.$this->tablename.'`('.$keys.') VALUES ('.$values.')';
        $rez = $this->database->query($Sql);

        echo $Sql;
       // echo $id_record = mysql_insert_id($rez);
       // return $id_record;
    }

    public function delete($fields)
    {
        $keys = '';
        $val = '';
        $values = '';
        foreach($fields as $name => $val)
        {
            $keys.=$name;
            if((sizeof($fields)-1)>$keys)
            {
                $keys.=',';
            }

            $values.='\''.addslashes($val).'\'';

            if((sizeof($fields)-1)>$keys)
            {
                $values.=',';
            }
        }
        $Sql = 'DELETE FROM '.$this->tablename.' WHERE '.$keys.'='.$values;
        $rez = $this->database->query($Sql);
        return mysql_affected_rows($rez);
    }

    public function update($fields, $where)
    {
        $expression='';
        reset($fields);
        $firstKey = key($fields);

        foreach($fields as $name=>$val)
        {
            if (trim($name) == $firstKey)
            {
                $expression.=' SET ';
            }
            else
            {
                $expression.=',';
            }
            $expression.=$name.'='.$this->CorrectedValue($val);
        }
        reset($where);
        $firstKey = key($where);

        foreach($where as $name=>$val)
        {
            if (trim($name) == $firstKey)
            {
                $expression.=' WHERE ';
            }
            else
            {
                $expression.=' AND ';

            }
            $expression.=$name.'='.$this->CorrectedValue($val);
        }
        $Sql = 'UPDATE '.$this->tablename.$expression;
        $rez = $this->database->query($Sql);

        return mysql_affected_rows($rez);
    }
}
?>