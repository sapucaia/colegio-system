<?php

//require_once 'IMigrationAdapter.php';
//require_once 'SqlServerTableDefinition.php';

/**
 * Description of SqlServerAdapter
 *
 * @author Lorrane
 */
class SqlServerAdapter implements IMigrationAdapter {

    protected $types = array(
        "int" => "INT",
        "string" => "NVARCHAR",
        "date" => "DATE",
        "timestamp" => "TIMESTAMP",
        "float" => "DECIMAL",
        "body" => "TEXT",
        "char" => "CHAR",
        "file" => "VARBINARY"
    );
    protected $database = "";
    protected $config;
    protected $conn;
    protected $base;
    protected $sgbd;
    protected $default_size = array(
        "string" => 255,
        "float" => "18, 0"
    );

    public function __construct($config) {
        $this->config = $config;
//        $this->database = $this->config["database"];
//        define('DBHOST', $this->config['host']);
//        define('DBNAME', $this->config['database']);
//        define('DBUSER', $this->config['user']);
//        define('DBPASS', $this->config['password']);
        $this->sgbd = $this->config['adapter'];
    }

    public function __get($propriedade) {
        if (method_exists($this, 'get_' . $propriedade)) {
            return call_user_func(array($this, 'get_' . $propriedade));
        } else {
            return $this->$propriedade;
        }
    }

    public function setDefaultBase() {
        $conf = $this->config;
        $this->host = $conf['host'];
        $this->database = $conf['database'];
        $this->user = $conf['user'];
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

    public function addColumn($tableName, $name, $type, $options = array()) {
        $column = new ColumnDefinition($this, $name, $type, $options);
        $sql = "ALTER TABLE %s ADD %s;";
        $sql = sprintf($sql, $tableName, $column->getSql());
        $this->executeSql($sql);
    }

    public function addIndex($tableName, $column, $indexName) {
        $sql = "CREATE UNIQUE NONCLUSTERED INDEX {$this->wrapIdentifier($indexName)} ON 
                [dbo].{$this->wrapIdentifier($tableName)}({$this->wrapIdentifier($column)}))";
        $this->executeSql($sql);
    }

    public function addPrimaryKey($tableName, $column, $primaryName = null) {
        $sql = "ALTER TABLE {$tableName} ADD CONSTRAINT {$primaryName} PRIMARY KEY ({$column})";
        $this->executeSql($sql);
    }

    public function createDatabase($db) {
        
    }

    public function createTable($tableName, $options = array()) {
        return new SqlServerTableDefinition($this, $tableName, $options);
    }

    public function dropDatabase($db) {
        
    }

    public function dropTable($table) {
        $sql = "DROP TABLE {$table}";
        $this->executeSql($sql);
    }

    public function removeColumn($tableName, $column) {
        $sql = "ALTER TABLE {$this->wrapIdentifier($tableName)} DROP COLUMN {$this->wrapIdentifier($column)}";
        $this->executeSql($sql);
    }

    public function removeIndex($tableName, $index) {
        $sql = "DROP INDEX {$tableName}.{$index}";
        $this->executeSql($sql);
    }

    public function renameColumn($tableName, $name, $newName) {
        $sql = "sp_RENAME '{$tableName}.{$name}', '{$newName}' , 'COLUMN'";
        $this->executeSql($sql);
    }

    public function renameTable($tableName, $newTableName) {
        $sql = "sp_rename {$tableName}, {$newTableName}";
        $this->executeSql($sql);
    }

    public function tableExists($table) {
        $sql = "SELECT 1 
                FROM INFORMATION_SCHEMA.TABLES 
                WHERE TABLE_TYPE='BASE TABLE' 
                AND TABLE_NAME='{$table}'";
        $result = $this->executeSql($sql);
        if (!$result->EOF) {
            return true;
        } else {
            return false;
        }
    }

    public function getExecutedMigrations() {
        $sql = "SELECT * FROM [dbo].[schema]";
        $result = $this->executeSql($sql);
        while (!$result->EOF) {
            $executadas[] = $result->fields[0];
            $result->MoveNext();
        }
        return $executadas;
    }

    public function getType($type) {
        return $this->types[$type];
    }

    /**
     * 
     * @param type $type
     * @param type $options
     * @return type
     */
    public function addOptions($type, $options) {
        $sql = "";
        if (array_key_exists('size', $options)) {
            $precision = "0";
            $size = $options['size'];
            if ($type === "DECIMAL") {
                if (array_key_exists('precision', $options)) {
                    $precision = $options['precision'];
                }
                $sql .= sprintf("(%s, %s)", $size, $precision);
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

        if (array_key_exists('auto_increment', $options)) {
            $sql .= " IDENTITY (1,1)";
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

    public function wrapIdentifier($identifier) {
        return "[" . $identifier . "]";
    }

    public function addUnique($tableName, $column, $uniqueName = null) {
        $sql = "ALTER [dbo].TABLE {$this->wrapIdentifier($tableName)} 
            ADD CONSTRAINT {$uniqueName} ({$this->wrapIdentifier($column)})";
        $this->executeSql($sql);
    }

    public function addReference($fkname, $table, $tableTarget, $column, $columnTarget = "id") {
        $sql = "ALTER TABLE {$this->wrapIdentifier($table)}
                ADD CONSTRAINT {$fkname} FOREIGN KEY ({$this->wrapIdentifier($column)})
                REFERENCES {$this->wrapIdentifier($tableTarget)} ({$this->wrapIdentifier($columnTarget)})";
        $this->executeSql($sql);
        $this->updateReferenceSchema($table, $tableTarget, $column, $columnTarget);
    }

    public function downSchemaVersion($version) {
        $sql = "DELETE FROM [SCHEMA] WHERE version = ('%s')";
        $sql = sprintf($sql, $version);
        return $this->executeSql($sql);
    }

    public function updateReferenceSchema($table, $table_target, $column, $column_target) {
        $sql = "INSERT INTO [schema_reference](table_name, table_target, column_name, column_target) VALUES('%s', '%s', '%s', '%s')";
        $sql = sprintf($sql, $table, $table_target, $column, $column_target);
        return $this->executeSql($sql);
    }

    public function updateSchemaVersion($version) {
        $sql = "INSERT INTO [schema] VALUES('%s')";
        $sql = sprintf($sql, $version);
        return $this->executeSql($sql);
    }

    public function updateTableSchema($table) {
        $sql = "INSERT INTO [schema_table](table_name) VALUES('%s')";
        $sql = sprintf($sql, $table);
        return $this->executeSql($sql);
    }

    public function updateSequenceSchema($table, $sequence) {
        $sql = "INSERT INTO [schema_sequence](table_name, sequence_name) VALUES('%s', '%s')";
        $sql = sprintf($sql, $table, strtoupper($sequence));
        return $this->executeSql($sql);
    }

    public function executeSql($sql) {
        try {
//            TTransaction::openBase($this->base);
            TTransaction::open($this->sgbd, $this->host, $this->database, $this->user, $this->pass);
            $conn = TTransaction::get();
//            $conn->SetFetchMode(ADODB_FETCH_ASSOC);
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

    public function removeReference($fkname, $table) {
        $sql = "ALTER TABLE [%s] DROP CONSTRAINT %s";
        $sql = sprintf($sql, $table, $fkname);
        return $this->executeSql($sql);
    }

    public function downSchemaTable($table) {
        $sql = "DELETE FROM [schema_table] WHERE table_name = '%s'";
        $sql = sprintf($sql, $table);
        return $this->executeSql($sql);
    }

    public function downSchemaReference($table) {
        $sql = "DELETE FROM [schema_reference] WHERE table_name = '%s'";
        $sql = sprintf($sql, $table);
        return $this->executeSql($sql);
    }

    public function downSchemaSequence($table) {
        $sql = "DELETE FROM [schema_sequence] WHERE table_name = '%s'";
        $sql = sprintf($sql, $table);
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
//                $fld = $result->FetchField($i);
//                $type = $result->MetaType($fld->type);
//                if ($type == 'C')
//                    $row[] = "'{$result->fields[$i]}'";
//                elseif ($type == 'I' or $type == 'N')
//                    $row[] = $result->fields[$i];
                if (is_string($result->fields[$i])) {
                    $row[] = "'{$result->fields[$i]}'";
                } elseif (is_numeric($result->fields[$i])) {
                    $row[] = $result->fields[$i];
                } elseif (is_null($result->fields[$i])) {
                    $row[] = "null";
                } else {
                    $row[] = "'{$result->fields[$i]}'";
                }
            }



            $data[] = implode(", ", $row);
            $result->moveNext();
        }
        return $data;
    }

    public function Columns($table) {
        TTransaction::open($this->sgbd, $this->host, $this->database, $this->user, $this->pass);
        $conn = TTransaction::get();
        return $conn->MetaColumnNames($table);
    }

    public function insert($table, $data) {
        $columns = $this->Columns($table);
        $col = array_keys($columns);
//        $col[0] = null;
        $col = implode(", ", $col);
//        $this->disableSequencies($table);
        $sqlSeq = "SELECT sequence_name FROM schema_sequence WHERE table_name = '%s'";
        $sqlSeq = sprintf($sqlSeq, $table);
        $resultSeq = $this->executeSql($sqlSeq);
        $sql = "";
        if (!$resultSeq->EOF) {
            $sql .="SET IDENTITY_INSERT [{$this->database}].[dbo].[{$table}] ON;";
        }
        $sql .=
                "INSERT INTO [{$this->database}].[dbo].[{$table}]({$col}) VALUES ({$data}); ";
        if (!$resultSeq->EOF) {
            $sql .="SET IDENTITY_INSERT [{$this->database}].[dbo].[{$table}] OFF;";
        }
        $result = $this->executeSql($sql);
//        $this->enableSequencies($table);
        return $result;
    }

    public function disableSequencies($table) {
        $sql = "SET IDENTITY_INSERT [{$this->database}].[dbo].[{$table}] ON";
        return $this->executeSql($sql);
    }

    public function enableSequencies($table) {
        $sql = "SET IDENTITY_INSERT [{$this->database}].[dbo].[{$table}] OFF";
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
            $sql = "SELECT * FROM schema_table WHERE table_name = '{$table}';";
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
