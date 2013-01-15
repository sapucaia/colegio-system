<?php

//require_once 'ColumnDefinition.php';
//require_once '../MigrationException.php';
//require_once 'TableDefinition.php';
//require_once '../../conf/lock.php';

/**
 * Description of OracleTableDefinition
 *
 * @author Paavo Soeiro
 */
class OracleTableDefinition extends TableDefinition {

//    protected $columns;
//    protected $primary_keys;
    protected $primary_key = null;
    protected $references = array();
    protected $sequencies = array();
    private $foreignSql = "FOREIGN KEY (%s) REFERENCES %s (%s)";
    protected $uniques;
    private $commits;

    public function __construct($adapter, $tableName, $options) {
        parent::__construct($adapter, $tableName, $options);
        if ($this->auto_generate_id) {
            $this->columns[] = new ColumnDefinition($adapter, "id", "int", array("auto_increment" => true));
        }
    }

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

    public function createAutoIncrement() {
        
    }

    public function end() {
        foreach ($this->columns as $column) {
            if (array_key_exists('auto_increment', $column->options)) {
                $seq = strtoupper("{$this->name}_{$column->name}_seq");
                if ($this->adapter->sequenceExists($seq)) {
                    $this->commits[] = "DROP SEQUENCE {$this->name}_{$column->name}_seq";
                }
                $this->commits[] = "CREATE SEQUENCE {$this->name}_{$column->name}_seq INCREMENT BY 1";
                $sequencies[$column->name] = "{$this->name}_{$column->name}_seq";
            }
        }

        $this->sql .= "CREATE TABLE {$this->name} (";

        //adiciona as colunas
        $fields = array();
        foreach ($this->columns as $column) {
            $fields[] = $column->getSql();
        }
        $this->sql .= implode(",\n", $fields);

        //adiciona a chave primaria
        //verificando se sera gerada automaticamente
        if ($this->auto_generate_id) {
            $sql .= ", PRIMARY KEY (id) ENABLE";
        } else {
            if ($this->primary_key != null) {
                $sql .= ", PRIMARY KEY ({$this->primary_key}) ENABLE";
            }
        }

        $this->sql .= $sql;

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

        $this->sql .= ") ";
        $this->commits['table'] = $this->sql;

        //create trigger for each sequencie
        foreach ($sequencies as $sequencie => $value) {
            $this->commits[] = "create or replace TRIGGER {$value}_TRG
                BEFORE INSERT ON {$this->name}
                FOR EACH ROW 
                    BEGIN
                        SELECT {$value}.NEXTVAL INTO :NEW.$sequencie FROM DUAL;
                    END;";
//            $this->sql .= "ALTER TABLE {$this->name} ALTER COLUMN {$sequencie} SET DEFAULT nextval('{$value}');\n";
        }
        foreach ($this->commits as $commit) {
//            print_r($commit);
            $this->adapter->executeSql($commit);
            $key = array_search($commit, $this->commits);
            if ($this->update && $key === 'table') {
                $this->adapter->updateTableSchema($this->name);
            }
        }foreach ($this->references as $reference) {
            $this->adapter->updateReferenceSchema($this->name, $reference["table"], $reference["column"], $reference["target"]);
        }
        if ($this->update) {
//                $this->adapter->updateTableSchema($this->name);
            foreach ($sequencies as $sequence) {
//            $table, $table_target, $column, $column_target
                $this->adapter->updateSequenceSchema($this->name, "{$sequence}_TRG");
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
