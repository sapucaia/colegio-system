<?php

//require_once 'IMigrationAdapter.php';
//require_once 'PGTableDefinition.php';
//require_once '../../conf/lock.php';

/**
 * Description of PostgresMigrationAdapter
 *
 * @author Lorrane
 */
class PostgresMigrationAdapter implements IMigrationAdapter {

    protected $schema = "";
    protected $database = "";
    protected $config;
    protected $conn;
    protected $base;
    protected $sgbd;
    protected $types = array(
        "int" => "INTEGER",
        "string" => "VARCHAR",
        "date" => "DATE",
        "timestamp" => "TIMESTAMP WITHOUT TIME ZONE",
        "float" => "NUMERIC",
        "body" => "TEXT",
        "char" => "CHAR",
        "file" => "bytea",
        "bool" => "boolean"
    );
    protected $default_size = array(
        "VARCHAR" => 255,
        "NUMERIC" => "18, 0"
    );

    public function __construct($config) {

        $this->config = $config;
//        $this->database = $this->config["database"];
        if (array_key_exists('schema', $config)) {
            $this->schema = $this->config['schema'];
        } else {
            $this->schema = "public";
        }
//        s
//        define('DBHOST', $this->config['host']);
//        define('DBNAME', $this->config['database']);
//        define('DBUSER', $this->config['user']);
//        define('DBPASS', $this->config['password']);
//        define('DBSGBD', $this->config['adapter']);
        $this->sgbd = $this->config['adapter'];
        //(DBHOST, DBUSER, DBPASS, DBNAME)
//        TTransaction::open($config['host'], $config['db'], $config['user'], $config['password']);
//        $this->conn = TTransaction::get();
    }

    public function setDefaultBase() {
        $conf = $this->config;
//        if (!defined('DBHOST'))
        $this->host = $conf['host'];
//        if (!defined('DBNAME'))
        $this->database = $conf['database'];
//        if (!defined('DBUSER'))
        $this->user = $conf['user'];
//        if (!defined('DBPASS'))
        $this->pass = $conf['password'];
    }

    public function setBase($base) {
        $this->base = $base;
        $conf = $this->config[$this->base];
        $this->host = $conf['host'];
        $this->sgbd = $conf['adapter'];
        $this->database = $conf['database'];
        $this->user = $conf['user'];
        $this->pass = $conf['password'];
    }

    public function __get($propriedade) {
        if (method_exists($this, 'get_' . $propriedade)) {
            return call_user_func(array($this, 'get_' . $propriedade));
        } else {
            return $this->$propriedade;
        }
    }

    public function addIndex($tableName, $column, $indexName) {
        $sql = "ALTER TABLE {$tableName} ADD CONSTRAINT {$indexName} UNIQUE ({$column});";
        print_r($sql);
    }

    public function addPrimaryKey($tableName, $column, $primaryName = null) {
        $sql = "ALTER TABLE {$tableName} ADD CONSTRAINT {$primaryName} PRIMARY KEY ({$column});";
        print_r($sql);
    }

    public function createDatabase($database) {
        $sql = "CREATE DATABASE {$database} WITH OWNER = " . $this->config['user'] . ";";
        try {
            TTransaction::open("localhost", '', "postgres", "postgres", false);
            $this->conn = TTransaction::get();
            $this->conn->Execute($sql);
            echo $this->conn->ErrorMsg();
            TTransaction::close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function createTable($tableName, $options = array()) {
        return new PGTableDefinition($this, $tableName, $options);
    }

    public function addColumn($tableName, $columnName, $type, $options = array()) {
        $column = new ColumnDefinition($this, $columnName, $type, $options);
        $sql = "ALTER TABLE %s ADD %s;";
        $sql = sprintf($sql, $tableName, $column->getSql());
        $this->executeSql($sql);
//        $default = "";
//        $nullable = "";
//
//        if (!empty($options['default'])) {
//            $default = "DEFAULT ({$options['default']})";
//        }
//
//        if (empty($options['null'])) {
//            $nullable = 'NOT NULL';
//        }
//
//        if (array_key_exists('size', $options)) {
//            $size = "({$options['size']})";
//        }
//
//        $sql = "ALTER TABLE {$tableName} ADD COLUMN {$columnName} " . $this->getType($type) . " {$size} {$nullable} {$default};";
//        print_r($sql);
//        try {
//            TTransaction::open();
//            //TTransaction::log($sql->getInstruction());
//
//            $conn = TTransaction::get();
//            $result = $conn->Execute($sql);
//
//            TTransaction::close();
//
//            if (!$result) {
//                throw new Exception('Erro!!');
//            } else {
//                return true;
//            }
//        } catch (exception $e) {
//            TTransaction::rollback();
//        }
    }

    public function dropTable($table) {
        $sql = "DROP TABLE {$table} CASCADE;";
        if ($this->executeSql($sql)) {
//            $this->dropSequence($table)
            $this->downSchemaTable($table);
            $this->downSchemaReference($table);
            $this->downSchemaSequence($table);
        }
    }

    public function downSchemaTable($table) {
        $sql = "DELETE FROM schema_table WHERE table_name = '%s'";
        $sql = sprintf($sql, $table);
        return $this->executeSql($sql);
    }

    public function downSchemaReference($table) {
        $sql = "DELETE FROM schema_reference WHERE table_name = '%s'";
        $sql = sprintf($sql, $table);
        return $this->executeSql($sql);
    }

    public function downSchemaSequence($table) {
        $sql = "DELETE FROM schema_sequence WHERE table_name = '%s'";
        $sql = sprintf($sql, $table);
        return $this->executeSql($sql);
    }

    public function removeColumn($tableName, $column) {
        if ($this->hasColumn($tableName, $column))
            $sql = "ALTER TABLE {$tableName} DROP COLUMN {$column};";
        else
            throw new ColumnNotExistsException();
        print_r($sql);
    }

    public function dropDatabase($db) {
        
    }

    public function databaseExists($database) {
        $sql = "SELECT 1 from pg_database WHERE datname='%s';";
        $sql = sprintf($sql, $database);
        try {
            TTransaction::open($this->host, '', $this->user, $this->pass, false);
            $this->conn = TTransaction::get();
            $result = $this->conn->Execute($sql);
            if ($result->FieldCount() > 0) {
                // percorre os resultados da consulta, retornando um objeto
                while (!$result->EOF) {
                    // armazena no array $results;
                    $results[] = $result->fetchObject($this->class . 'Record');

                    $result->moveNext();
                }
            }


            TTransaction::close();
            $this->conn = null;
//            if ($result->EOF) {
            if (count($results) == 0) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function removeIndex($tableName, $index) {
        $sql = "DROP INDEX %s";
        $sql = sprintf($sql, $index);
        $this->executeSql($sql);
    }

    public function renameColumn($tableName, $name, $newName) {
        if ($this->hasColumn($tableName, $name))
            $sql = "ALTER TABLE {$tableName} RENAME {$name} TO {$newName};";
        else
            throw new ColumnNotExistsException();
        $this->executeSql($sql);
    }

    public function renameTable($tableName, $newTableName) {
        $sql = "ALTER TABLE {$tableName} RENAME TO {$newTableName};";
        $this->executeSql($sql);
    }

    public function getExecutedMigrations() {
        $sql = "SELECT * FROM schema";
        $result = $this->executeSql($sql);
        while (!$result->EOF) {
            $executadas[] = $result->fields['version'];
            $result->MoveNext();
        }
        return $executadas;
    }

    public function tableExists($table) {
//        $sql = "SELECT EXISTS(SELECT 1 FROM information_schema.tables 
//                WHERE table_catalog='{$this->database}' AND 
//                table_schema='{$this->schema}' AND 
//                table_name='{$table}');";
        $sql = "SELECT 1 FROM information_schema.tables 
                WHERE table_catalog='%s' AND 
                table_schema='%s' AND 
                table_name='%s';";
//        $sql = "SELECT EXISTS(SELECT 1 FROM information_schema.tables 
//                WHERE table_catalog='%s' AND 
//                table_schema='%s' AND 
//                table_name='%s');";
        $sql = sprintf($sql, $this->database, $this->schema, $table);
//        print_r($sql);
        TTransaction::open($this->sgbd, $this->host, $this->database, $this->user, $this->pass);
        $this->conn = TTransaction::get();
        $result = $this->conn->Execute($sql);
        TTransaction::close();
        if ($result->EOF) {
            return false;
        } else {
            return true;
        }
    }

    public function addOptions($type, $options) {
        $sql = "";
        if (array_key_exists('size', $options)) {
            $precision = "0";
            $size = $options['size'];
            if ($type === "NUMERIC") {
                if (array_key_exists('precision', $options)) {
                    $precision = $options['precision'];
                }
                $sql .= sprintf("(%d', %d)", $size, $precision);
            } else {
                $sql .= sprintf("(%d)", $size);
            }
        } else {
            if (array_key_exists($type, $this->default_size)) {
                $sql .= "({$this->default_size[$type]})";
            }
        }

        if (array_key_exists('null', $options)) {
            if ($options['null'] === false) {
                $sql.=" NOT NULL";
            }
        }
        if (array_key_exists('default', $options)) {
//  $sql .= "DEFAULT '{$options['default']}'";
            if (is_int($options['default'])) {
                $default_format = '%d';
            } elseif (is_bool($options['default'])) {
                $default_format = "'%d'";
            } else {
                $default_format = "'%s'";
            }
            $default_value = sprintf($default_format, $options['default']);

            $sql .= sprintf(" DEFAULT %s", $default_value);
        }
//$sql2 = sprintf($sql, $size);
        return $sql;
    }

    public function getType($type) {
        return $this->types[$type];
    }

    private function hasColumn($table, $column) {
        $sql = "SELECT a.relname AS Tabela, b.attname AS Campo
                FROM pg_class a
                JOIN pg_attribute b ON (b.attrelid = a.relfilenode)
                WHERE  b.attstattarget = -1 AND
                a.relname = '%s' AND  b.attname = '%s';";
        $sql = sprintf($sql, $table, $column);
        $this->executeSql($sql);
    }

    public function executeSql($sql) {
        try {
//            TTransaction::openBase($this->base);
            TTransaction::open($this->sgbd, $this->host, $this->database, $this->user, $this->pass);
            $conn = TTransaction::get();
            $result = $conn->Execute($sql);
            TTransaction::close();
            if (!$result) {
                return false;
            } else {
                return $result;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function addUnique($tableName, $column, $uniqueName = null) {
        $sql = "ALTER TABLE %s ADD CONSTRAINT %s UNIQUE (%s)";
        $sql = sprintf($sql, $tableName, $uniqueName, $column);
        $this->executeSql($sql);
//        $sql = "ALTER TABLE distributors ADD CONSTRAINT dist_id_zipcode_key UNIQUE (dist_id, zipcode)";
    }

    public function addReference($fkname, $table, $tableTarget, $column, $columnTarget = "id") {
        $sql = "ALTER TABLE {$table}
                ADD CONSTRAINT {$fkname} FOREIGN KEY ({$column})
                REFERENCES {$tableTarget} ({$columnTarget})";
        $this->executeSql($sql);
        $this->updateReferenceSchema($table, $tableTarget, $column, $columnTarget);
    }

    public function updateSchemaVersion($version) {
        $sql = "INSERT INTO schema VALUES('%s')";
        $sql = sprintf($sql, $version);
        return $this->executeSql($sql);
    }

    public function downSchemaVersion($version) {
        $sql = "DELETE FROM SCHEMA WHERE version = ('%s')";
        $sql = sprintf($sql, $version);
        return $this->executeSql($sql);
    }

    public function updateTableSchema($table) {
        $sql = "INSERT INTO schema_table(table_name) VALUES('%s')";
        $sql = sprintf($sql, $table);
        return $this->executeSql($sql);
    }

    public function updateReferenceSchema($table, $table_target, $column, $column_target) {
        $sql = "INSERT INTO schema_reference(table_name, table_target, column_name, column_target) VALUES('%s', '%s', '%s', '%s')";
        $sql = sprintf($sql, $table, $table_target, $column, $column_target);
        return $this->executeSql($sql);
    }

    public function removeReference($fkname, $table) {
        $sql = "ALTER TABLE %s DROP CONSTRAINT %s";
        $sql = sprintf($sql, $table, $fkname);
        return $this->executeSql($sql);
    }

    public function select($table) {
        $sql = "SELECT * FROM %s";
        $sql = sprintf($sql, $table);
        $result = $this->executeSql($sql);
        $count = $result->FieldCount();
        while (!$result->EOF) {
            $row = array();
            for ($i = 0; $i < $count; $i++) {
                $fld = $result->FetchField($i);
                $type = $result->MetaType($fld->type);
                if ($type == 'C')
                    $row[] = "'{$result->fields[$i]}'";
                elseif ($type == 'I')
                    $row[] = $result->fields[$i];
                elseif ($type == 'N')
                    $row[] = $result->fields[$i];
                else
                    $row[] = "'{$result->fields[$i]}'";
            }
            $data[] = implode(", ", $row);
            $result->moveNext();
        }
        return $data;
    }

    public function insert($table, $data) {
        $sql = "INSERT INTO {$table} VALUES ({$data})";
        return $this->executeSql($sql);
    }

    public function disableSequencies($table) {
        
    }

    public function enableSequencies($table) {
        
    }

    public function Columns($table) {
        TTransaction::open($this->sgbd, $this->host, $this->database, $this->user, $this->pass);
        $conn = TTransaction::get();
        return $conn->MetaColumnNames($table);
    }

    public function getTables($table = null) {
//        $this->setBase($origin);
        if ($table === null) {
            $sql = "SELECT * FROM schema_table";
            $result = $this->executeSql($sql);
            while (!$result->EOF) {
                $tables[] = $result->fetchObject();
                $result->moveNext();
            }
            return $tables;
        } else {
            $sql = "SELECT * FROM schema_table WHERE table_name = '{$table}'";
            $result = $this->executeSql($sql);
            if (!$result->EOF) {
                $table = $result->fetchObject();
                $result->moveNext();
            }
            return $table;
        }
    }

    public function getReferences($table) {
        $sql = "SELECT * FROM schema_reference WHERE TABLE_NAME = '%s'";
        $sql = sprintf($sql, $table);
        $result = $this->executeSql($sql);
        while (!$result->EOF) {
            $references[] = $result->fetchObject();
            $result->moveNext();
        }
        return $references;
    }

}

?>
