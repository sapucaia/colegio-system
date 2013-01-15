<?php

//require_once 'ColumnDefinition.php';
//require_once '../MigrationException.php';
//require_once 'TableDefinition.php';
//require_once '../../conf/lock.php';

/**
 * Description of TableDefinition
 *
 * @author Paavo Soeiro
 */
class PGTableDefinition extends TableDefinition {

//    protected $columns;
//    protected $primary_keys;
    protected $primary_key = null;
    protected $references = array();
    private $foreignSql = "FOREIGN KEY (%s) REFERENCES %s (%s)";
    protected $uniques;

    /**
     * 
     * @param type $adapter
     * @param type $tableName
     * @param type $options
     */
    public function __construct($adapter, $tableName, $options) {
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
//        if($this->auto_generate_id === false){
//            
//        }
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
                // $column_options['null'] = false;
            }
        }

//        if (array_key_exists('auto_increment', $options)) {
//            if ($options['auto_increment'] === true) {
////                echo 'AUTO_INCREMENTO';
//                $column_options['auto_increment'] = true;
//            }
//        }

        $column_options = array_merge($column_options, $options);
        //echo $column_options;
        //  print_r($column_options);
        $column = new ColumnDefinition($this->adapter, $columnName, $type, $column_options);
        $this->columns[] = $column;
    }

    /**
     * 
     * @param type $tableTarget
     * @param type $column
     * @param type $columnTarget
     */
    public function reference($tableTarget, $column, $columnTarget = "id") {
        if ($tableTarget == null || $tableTarget === "") {
            throw new ReferenceTableNotDefinedExption();
        }
        if ($column == null) {
            $column = $tableTarget . "_id";
        }
        $this->column('int', $column);
        $this->references[] = array("table" => $tableTarget, "column" => $column, "target" => $columnTarget);
//"FOREIGN KEY (regras_id) REFERENCES temporario.regras (id)"
        //$this->sql = "";
    }

    /**
     * 
     * @param type $columnName
     * @param type $size
     * @param type $options
     */
    public function addColumnString($columnName, $size = 255, $options = array()) {
        $this->column("string", $columnName, $size, $options);
    }

    public function addColumnInt($columnName, $size = 11, $options = array()) {
        $this->column("INT", $columnName, $size, $options);
    }

    public function end() {
        //cria sequencias
        foreach ($this->columns as $column) {
            if (array_key_exists('auto_increment', $column->options)) {
                //   $this->createAutoIncrement();

                $this->sql .= "DROP SEQUENCE IF EXISTS {$this->name}_{$column->name}_seq;";
                $this->sql .= "CREATE SEQUENCE {$this->name}_{$column->name}_seq INCREMENT 1;";
                $sequencies[$column->name] = "{$this->name}_{$column->name}_seq";
            }
        }

        $this->sql .= "CREATE TABLE {$this->name} (\n";
        //adiciona as colunas
        $fields = array();
        foreach ($this->columns as $column) {
            $fields[] = $column->getSql();
        }
        $this->sql .= implode(",\n", $fields);

        //adiciona a chave primaria
        //verificando se sera gerada automaticamente
        if ($this->auto_generate_id) {
            $sql .= ", PRIMARY KEY (id)";
        } else {
            if ($this->primary_key != null) {
                $sql .= ", PRIMARY KEY ({$this->primary_key})";
            }
        }

        $this->sql .= $sql;

        if (count($this->uniques) > 0) {
            $this->sql .=",";
            foreach ($this->uniques as $key) {
                $unique[] = " UNIQUE ({$key})";
            }
        }
        $this->sql .= implode(",\n", $unique);


        if (count($this->references)) {
            $this->sql .=",";
            foreach ($this->references as $reference) {
                $references[] = sprintf($this->foreignSql, $reference["column"], $reference["table"], $reference["target"]);
            }
        }
        $this->sql .= implode(",\n", $references);
        $this->sql .= ");";
        //ALTER TABLE tabela ALTER COLUMN id SET DEFAULT nextval('tabela_id_seq'::regclass);
//        if(isset($sequ))
        foreach ($sequencies as $sequencie => $value) {
            $this->sql .= "ALTER TABLE {$this->name} ALTER COLUMN {$sequencie} SET DEFAULT nextval('{$value}');\n";
        }
        print_r($this->sql);

        $this->adapter->executeSql($this->sql);
        if ($this->update)
            $this->adapter->updateTableSchema($this->name);
        foreach ($this->references as $reference) {
//            $table, $table_target, $column, $column_target
            $this->adapter->updateReferenceSchema($this->name, $reference["table"], $reference["column"], $reference["target"]);
        }
    }

}

?>
