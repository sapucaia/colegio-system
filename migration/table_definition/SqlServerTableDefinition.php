<?php

/**
 * Description of SqlServerTableDefinition
 *
 * @author Paavo Soeiro
 */
class SqlServerTableDefinition extends TableDefinition {

//    protected $primary_keys;
    protected $primary_key = null;
    protected $references = array();
    private $foreignSql = "FOREIGN KEY (%s) REFERENCES %s (%s)";
    protected $uniques;

    public function __construct($adapter, $tableName, $options = array()) {
        parent::__construct($adapter, $tableName, $options);
        if ($this->auto_generate_id) {
            $this->columns[] = new ColumnDefinition($adapter, "id", "int", array("auto_increment" => true));
        }
    }

    /**
     * 
     * @param type $type
     * @param type $columnName
     * @param type $options
     * @throws PrimaryKeyAlreadyExistsException
     */
    public function column($type, $columnName, $options = array()) {

        $column_options = array();

        if (array_key_exists('primary_key', $options)) {
            if (!$this->auto_generate_id) {
                if ($options['primary_key'] == true) {
                    $this->primary_key = $columnName;
                    $column_options['null'] = false;
                }
            } else {
                throw new PrimaryKeyAlreadyExistsException();
            }
        }

        if (array_key_exists('unique', $options)) {
            if ($options['unique'] == true) {
                $this->uniques[] = $columnName;
            }
        }

        $column_options = array_merge($column_options, $options);
        $column = new ColumnDefinition($this->adapter, $columnName, $type, $column_options);
        $this->columns[] = $column;
    }

    public function end() {
//        $this->sql .= "USE " . $this->adapter->wrapIdentifier($this->adapter->config['database']) . " \nGO ";
        $sequences = null;
        foreach ($this->columns as $column) {
            if (array_key_exists('auto_increment', $column->options)) {
                $sequences[$column->name] = "{$this->name}";
            }
        }
        $this->sql .= "CREATE TABLE " . $this->adapter->wrapIdentifier($this->name) . " (";

        //adiciona colunas
        $fields = array();
        foreach ($this->columns as $column) {
            $fields[] = $column->getSql();
        }
        $this->sql .= implode(",\n", $fields);

        //adiciona a chave primaria
        //verificando se sera gerada automaticamente
        if ($this->auto_generate_id) {
            $this->sql .= ", PRIMARY KEY (id)";
        } else {
            if ($this->primary_key != null) {
                $this->sql .= ", PRIMARY KEY ({$this->primary_key})";
            }
        }

        if (count($this->uniques) > 0) {
            $this->sql .=",";
            foreach ($this->uniques as $key) {
                $unique[] = " UNIQUE ({$key})";
            }
            $this->sql .= implode(",\n", $unique);
        }


        if (count($this->references)) {
            $this->sql .=",";
            foreach ($this->references as $reference) {
                $references[] = sprintf($this->foreignSql, $reference["column"], $reference["table"], $reference["target"]);
            }
            $this->sql .= implode(",\n", $references);
        }

        $this->sql .= ")";

//        print_r($this->sql);
        $this->adapter->executeSql($this->sql);
        if ($this->update)
            $this->adapter->updateTableSchema($this->name);
        foreach ($this->references as $reference) {
//            $table, $table_target, $column, $column_target
            $this->adapter->updateReferenceSchema($this->name, $reference["table"], $reference["column"], $reference["target"]);
        }

        if ($this->update) {
//                $this->adapter->updateTableSchema($this->name);
            if ($sequences !== null) {
                foreach ($sequences as $sequence) {
//            $table, $table_target, $column, $column_target
                    $this->adapter->updateSequenceSchema($this->name, "{$sequence}");
                }
            }
        }
    }

    public function reference($tableTarget, $column, $columnTarget = "id") {
        if ($tableTarget == null || $tableTarget === "") {
            throw new ReferenceTableNotDefinedExption();
        }
        if ($column == null) {
            $column = $tableTarget . "_id";
        }
        $this->column('int', $column);
        $this->references[] = array("table" => $tableTarget, "column" => $column, "target" => $columnTarget);
    }

}

?>
