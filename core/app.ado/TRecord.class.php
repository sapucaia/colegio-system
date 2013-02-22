<?php

//Classe para abstração com banco de dados
/**
 *  Implementa o padrão Active Record
 *  
 */
abstract class TRecord extends TCriteria {

    protected $data;
    protected $db;

    public function __construct() {
//        $db = file_get_contents('../db/db.inc.dbt');
////        while (!feof($file_handle)) {
////            $db = fgets($file_handle);
////        }
////        fclose($file_handle);
//        if ($db !== false) {
//            $tmp = file_get_contents("../db/{$db}.db");
//            $this->db = unserialize($tmp);
//        }
    }

    public function __clone() {
        unset($this->id);
    }

    //Dependency injection
    public function __get($propriedade) {
        if (method_exists($this, 'get_' . $propriedade)) {
            return call_user_func(array($this, 'get_' . $propriedade));
        } else {
            return $this->data[$propriedade];
        }
    }

    public function __set($propriedade, $value) {
        if (method_exists($this, 'set_' . $propriedade)) {
            return call_user_func(array($this, 'set_' . $propriedade), $value);
        } else {
            $this->data[$propriedade] = $value;
        }
    }

    /**
     * Retorna o nome da tabela
     * @return string Nome da tabela 
     */
    public function getEntity() {
        $classe = strtolower(get_class($this));
        $tabela = substr($classe, 0, -6);
        return $tabela;
    }

    public function fromArray($dados) {
        $this->data = $dados;
    }

    public function toArray() {
        return $this->data;
    }

    public function last_id() {
        TTransaction::open();

        $conn = TTransaction::get();
        $result = $conn->Insert_ID();

        TTransaction::close();

        return $result;
    }

    private function is_date($value, $format = 'yyyy-mm-dd') {

        if (strlen($value) == 10 && strlen($format) == 10) {

            // find separator. Remove all other characters from $format
            $separator_only = str_replace(array('m', 'd', 'y'), '', $format);
            $separator = $separator_only[0]; // separator is first character

            if ($separator && strlen($separator_only) == 2) {
                // make regex
                $regexp = str_replace('mm', '[0-1][0-9]', $value);
                $regexp = str_replace('dd', '[0-3][0-9]', $value);
                $regexp = str_replace('yyyy', '[0-9]{4}', $value);
                $regexp = str_replace($separator, "\\" . $separator, $value);

                if ($regexp != $value && preg_match('/' . $regexp . '/', $value)) {

                    // check date
                    $day = substr($value, strpos($format, 'd'), 2);
                    $month = substr($value, strpos($format, 'm'), 2);
                    $year = substr($value, strpos($format, 'y'), 4);

                    if (@checkdate($month, $day, $year))
                        return true;
                }
            }
        }
        return false;
    }

    public function save() {
        $sql = new TSqlInsert;
        $sql->setEntity($this->getEntity());

        foreach ($this->data as $key => $value) {
            if ($this->is_date($value) && $this->db->sgbd === "oci8") {
                $this->$key = "TO_DATE('{$this->$key}', 'DD/MM/RR')";
            }
            $sql->setRowData($key, $this->$key);
        }

        try {
//            TTransaction::open();
            TTransaction::open($this->db->sgbd, $this->db->host, $this->db->database, $this->db->user, $this->db->pass);
            //TTransaction::log($sql->getInstruction());

            $conn = TTransaction::get();

//            echo $sql->getInstruction() . "<br>\n";
            $result = $conn->Execute($sql->getInstruction());

            TTransaction::close();

            if (!$result) {
                throw new Exception('Erro ao Inserir !!');
            } else {
                return true;
            }
        } catch (exception $e) {
            TTransaction::rollback();
        }
    }

    public function update($cod) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('id' . $this->getEntity(), '=', $cod));

        $sql = new TSqlUpdate;
        $sql->setEntity($this->getEntity());
        $sql->setCriteria($criteria);

        foreach ($this->data as $key => $value) {
            if ($key != 'id' . $this->getEntity()) {
                $sql->setRowData($key, $this->$key);
            }
        }
        try {
//            TTransaction::open();
            TTransaction::open($this->db->sgbd, $this->db->host, $this->db->database, $this->db->user, $this->db->pass);
            //TTransaction::log($sql->getInstruction());

            $conn = TTransaction::get();
            $result = $conn->Execute($sql->getInstruction());

            TTransaction::close();

            if (!$result) {
                throw new Exception('Erro!!');
            } else {
                return true;
            }
        } catch (exception $e) {
            TTransaction::rollback();
        }
    }

    public function load(TCriteria $criteria) {
        $sql = new TSqlSelect;
        $sql->setEntity($this->getEntity());
        $sql->column('*');
        $sql->setCriteria($criteria);

        try {
            TTransaction::open($this->db->sgbd, $this->db->host, $this->db->database, $this->db->user, $this->db->pass);
//            TTransaction::open();
            //TTransaction::log($sql->getInstruction());

            $conn = TTransaction::get();
            $conn->SetFetchMode(ADODB_FETCH_ASSOC);
            $result = $conn->Query($sql->getInstruction());

            TTransaction::close();

            return $result;
        } catch (exception $e) {
            TTransaction::rollback();
        }
    }

    public function delete(TCriteria $criteria) {

        $sql = new TSqlDelete;
        $sql->setEntity($this->getEntity());
        $sql->setCriteria($criteria);

        try {
//            TTransaction::open();
            TTransaction::open($this->db->sgbd, $this->db->host, $this->db->database, $this->db->user, $this->db->pass);
            //TTransaction::log($sql->getInstruction());

            $conn = TTransaction::get();
            $result = $conn->Execute($sql->getInstruction());

            TTransaction::close();

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (exception $e) {
            TTransaction::rollback();
        }
    }

}

?>
