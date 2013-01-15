<?php

/**
 *
 * @author Paavo Soeiro
 */
interface IMigrationAdapter {

    public function createDatabase($db);

    public function createTable($tableName, $options = array());

    public function dropDatabase($db);

    public function dropTable($table);

    public function tableExists($table);

    public function renameTable($tableName, $newTableName);

    public function removeColumn($tableName, $column);

    public function addColumn($tableName, $name, $type, $options = array());

    public function renameColumn($tableName, $name, $newName);

    public function addIndex($tableName, $column, $indexName);

    public function removeIndex($tableName, $index);

    public function addUnique($tableName, $column, $uniqueName = null);

    public function addPrimaryKey($tableName, $column, $primaryName = null);

    public function addReference($fkname, $table, $tableTarget, $column, $columnTarget = "id");

    public function removeReference($fkname, $table);

    public function getType($type);

    public function addOptions($type, $options);

    public function getExecutedMigrations();

    public function updateSchemaVersion($version);

    public function downSchemaVersion($version);

    public function updateTableSchema($table);

    public function updateReferenceSchema($table, $table_target, $column, $column_target);
}

?>
