<?php

/**
 * Description of OracleMigrationAdapter
 *
 * @author Paavo Soeiro
 */
class OracleMigrationAdapter implements IMigrationAdapter {

    protected $distributed = false;
    protected $config;
    protected $base;
    protected $host;
    protected $database;
    protected $user;
    protected $pass;
    protected $sgbd;
    protected $types = array(
        "int" => "INT",
        "string" => "VARCHAR2",
        "date" => "DATE",
        "timestamp" => "TIMESTAMP",
        "float" => "NUMBER",
        "body" => "VARCHAR2",
        "char" => "CHAR",
        "file" => "BFILE"
    );
    protected $default_size = array(
        "string" => 255,
        "float" => "18, 0"
    );

    public function __construct($config) {

        $this->config = $config;
//        define('DBSGBD', $this->config['adapter']);
        $this->sgbd = $this->config['adapter'];
    }

    public function setBase($base) {
        $this->base = $base;
        $conf = $this->config[$this->base];
        $this->sgbd = $conf['adapter'];
        $this->host = $conf['host'];
        $this->database = $conf['database'];
        $this->user = $conf['user'];
        $this->pass = $conf['password'];
    }

    public function setDefaultBase() {
        $conf = $this->config;
        $this->host = $conf['host'];
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

    public function addColumn($tableName, $name, $type, $options = array()) {
        $column = new ColumnDefinition($this, $name, $type, $options);
        $sql = "ALTER TABLE %s ADD (%s)";
        $sql = sprintf($sql, $tableName, $column->getSql());
        $this->executeSql($sql);
    }

    public function addIndex($tableName, $column, $indexName) {

        $sql = "CREATE INDEX %s ON %s (%s)";
        if (is_array($column))
            $column = explode(",", $column);
        $sql = sprintf($sql, $indexName, $tableName, $column);
        $this->executeSql($sql);
    }

    public function addOptions($type, $options) {
        $sql = "";
        if (array_key_exists('size', $options)) {
            $precision = "0";
            $size = $options['size'];
            if ($type === "NUMBER") {
                if (array_key_exists('precision', $options)) {
                    $precision = $options['precision'];
                }
                $sql .= sprintf("(%s, %s)", $size, $precision);
            } elseif ($type === "VARCHAR2") {
                $sql .= sprintf("(%s CHAR)", $size);
            } else {
                $sql .= sprintf("(%s)", $size);
            }
        } else {
            $key = array_search($type, $this->types);
            if (array_key_exists($key, $this->default_size)) {
                $sql .= "({$this->default_size[$key]})";
            }
        }
        if (array_key_exists('null', $options)) {
            if ($options['null'] === false) {
                $sql.=" NOT NULL";
            }
        }

        if (array_key_exists('default', $options)) {
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
        return $sql;
    }

    public function addPrimaryKey($tableName, $column, $primaryName = null) {
        
    }

    public function createDatabase($db) {
        
    }

    public function createTable($tableName, $options = array()) {
        return new OracleTableDefinition($this, $tableName, $options);
    }

    public function dropDatabase($db) {
        
    }

    public function dropTable($table, $cascade = false) {
        $sql = "DROP TABLE %s";
        $sql = sprintf($sql, $table);
        if ($cascade)
            $sql .= "CASCADE CONSTRAINTS";
        if ($this->executeSql($sql)) {
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

    private function dropSequence($sequence) {
        $sql = "DROP SEQUENCE {$sequence}";
        $this->executeSql($sql);
    }

    public function getType($type) {
        return $this->types[$type];
    }

    public function removeColumn($tableName, $column) {
        $sql = "ALTER TABLE %s DROP COLUMN %s";
        $sql = sprintf($sql, $tableName, $column);
        $this->executeSql($sql);
    }

    public function removeIndex($tableName, $index) {
        $sql = "DROP INDEX %s";
        $sql = sprintf($sql, $index);
        $this->executeSql($sql);
    }

    public function renameColumn($tableName, $name, $newName) {
        $sql = "ALTER TABLE %s RENAME COLUMN %s TO %s";
        $sql = sprintf($sql, $tableName, $name, $newName);
        $this->executeSql($sql);
    }

    public function renameTable($tableName, $newTableName) {
        $sql = "ALTER TABLE %s RENAME to %s";
        $sql = sprintf($sql, $tableName, $newTableName);
        $this->executeSql($sql);
    }

    public function databaseExists($database) {
        $sql = "SELECT 1 FROM sys.sysdatabases where name='{$database}'";
        try {
            TTransaction::open();
            $conn = TTransaction::get();
            $result = $conn->Execute($sql);
            TTransaction::close();
            if (!$result) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    public function tableExists($table) {
        $sql = "select table_name from user_tables where table_name='%s'";
        $sql = sprintf($sql, strtoupper($table));
        try {
            TTransaction::open($this->sgbd, $this->host, $this->database, $this->user, $this->pass);
            $conn = TTransaction::get();
//            $databases = $conn->Execute($conn->metaDatabasesSQL);

            $result = $conn->Execute($sql);
            TTransaction::close();
            if ($result->EOF) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
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
        $sql = "INSERT INTO schema_table VALUES('%s')";
        $sql = sprintf($sql, $table);
        return $this->executeSql($sql);
    }

    public function updateReferenceSchema($table, $table_target, $column, $column_target) {
        $sql = "INSERT INTO schema_reference(table_name, table_target, column_name, column_target) VALUES('%s', '%s', '%s', '%s')";
        $sql = sprintf($sql, $table, $table_target, $column, $column_target);
        return $this->executeSql($sql);
    }

    public function updateSequenceSchema($table, $sequence) {
        $sql = "INSERT INTO schema_sequence(table_name, sequence_name) VALUES('%s', '%s')";
        $sql = sprintf($sql, $table, strtoupper($sequence));
        return $this->executeSql($sql);
    }

    public function getExecutedMigrations() {
        $sql = "SELECT * FROM schema";
        $result = $this->executeSql($sql);
        while (!$result->EOF) {
            $executadas[] = $result->fields['VERSION'];
            $result->MoveNext();
        }
        return $executadas;
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
        $sql = "ALTER TABLE %s ADD CONSTRAINT %s UNIQUE(%s)";
//verificar uniqueName = null
        $sql = sprintf($sql, $tableName, $uniqueName, $column);
        $this->executeSql($sql);
//        $sql = "ALTER TABLE sales ADD CONSTRAINT sales_unique UNIQUE(sales_id);";
    }

    public function addReference($fkname, $table, $tableTarget, $column, $columnTarget = "id") {
        $sql = "ALTER TABLE {$table}
                ADD CONSTRAINT {$fkname} FOREIGN KEY ({$column})
                REFERENCES {$tableTarget} ({$columnTarget})";
        $this->executeSql($sql);
        $this->updateReferenceSchema($table, $tableTarget, $column, $columnTarget);
    }

    public function createDatabaseLinks() {
        $bases = $this->config;
        unset($bases["adapter"]);
        foreach ($bases as $key => $base) {
            $dblinks = $bases;
            unset($dblinks[$key]);
            foreach ($dblinks as $keylink => $link) {
                $this->setBase($key);
                if (!$this->getDatabaseLink(strtoupper($keylink))) {

                    $sql = "CREATE DATABASE LINK \"{$keylink}\" CONNECT TO {$this->base['user']} IDENTIFIED BY {$this->base['pass']} USING '{$link['database']}'";
                    $this->executeSql($sql);
                } else {
                    echo "DATABASE LINK {$keylink} already exists in {$link['database']}";
                }
            }
        }
    }

    public function getDatabaseLink($link) {
        $sql = "select * from dba_db_links WHERE DB_LINK = '{$link}'";
        $result = $this->executeSql($sql);
        while (!$result->EOF) {
            $dblinks[] = strtolower($result->fields["DB_LINK"]);
            $result->MoveNext();
        }
        return $dblinks;
    }

    public function removeReference($fkname, $table) {
        $sql = "ALTER TABLE %s DROP CONSTRAINT %s";
        $sql = sprintf($sql, $table, $fkname);
        return $this->executeSql($sql);
    }

    public function sequenceExists($sequence) {
        $sql = "select * from all_sequences where sequence_name = '" . strtoupper($sequence) . "'";
        return $this->executeSql($sql);
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
        $sql = "SELECT sequence_name FROM schema_sequence WHERE table_name = '%s'";
        $sql = sprintf($sql, $table);
        $result = $this->executeSql($sql);
        while (!$result->EOF) {
            $sequence = $result->fields[0];
            $disable = "alter trigger {$sequence} disable";
            $this->executeSql($disable);
            $result->moveNext();
        }
    }

    public function enableSequencies($table) {
        $sql = "SELECT sequence_name FROM schema_sequence WHERE table_name = '%s'";
        $sql = sprintf($sql, $table);
        $result = $this->executeSql($sql);
        while (!$result->EOF) {
            $sequence = $result->fields[0];
            $disable = "alter trigger {$sequence} enable";
            $this->executeSql($disable);
            $result->moveNext();
        }
    }

}

?>
