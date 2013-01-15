<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Record
 *
 * @author Paavo Soeiro
 */
class Record {

    public function select($table) {
        $sql = "SELECT * FROM %s";
        $sql = sprintf($sql, $table);
        $result = $this->executeSql($sql);
        $count = $result->FieldCount();
        while (!$result->EOF) {
            $row = array();
            for ($i = 0; $i <= $count; $i++) {
                $fld = $result->FetchField($i);
                $type = $result->MetaType($fld->type);
                if ($type == 'C')
                    $row[] = "'{$result->fields[$i]}'";
                elseif ($type == 'I')
                    $row[] = $result->fields[$i];
            }
            $data = implode(", ", $row);
            $result->moveNext();
        }
        return $data;
    }

    public function insert($table, $data) {
        $sql = "INSERT INTO {$table} VALUES ({$data})";
        return $this->executeSql($sql);
    }

}

?>
