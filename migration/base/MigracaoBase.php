<?php

//require_once 'TMigration.php';
//require_once 'adapters/AdapterFactory.php';

/**
 * Description of MigracaoBase
 *
 * @author Paavo Soeiro
 */
abstract class MigracaoBase implements IMigration {

    protected $tableName;
    protected $columns = array();
    protected $options;
    protected $adapter;

//    private $adapter = "sqlserver";

    public function __construct(IMigrationAdapter $adapter = null) {
//        $this->adapter = AdapterFactory::getAdapter($adapter);
        $this->adapter = $adapter;
    }

    /**
     * 
     * @param IMigrationAdapter $adapter
     */
    public function setAdapter(IMigrationAdapter $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * 
     * Metodo para iniciar a definição de uma tabela
     * 
     * @param string $tableName nome tabela
     * @param array $options opções tabela
     * @return TableDefinition
     */
    public function createTable($tableName, $options = array()) {
        return $this->adapter->createTable($tableName, $options);
    }

    /**
     * 
     * Metodo para adicionar uma coluna de uma tabela
     * 
     * @param sitrng $tableName nome tabela
     * @param string $columnName nome coluna
     * @param string $type tipo da coluna
     * @param array $options opções da coluna
     */
    public function addColumn($tableName, $columnName, $type, $options) {
        $this->adapter->addColumn($tableName, $columnName, $type, $options);
    }

    /**
     * Metodo para remover uma coluna de uma tabela
     * 
     * @param string $tableName nome da tabela
     * @param string $columnName nome da coluna a ser removida
     */
    public function removeColumn($tableName, $columnName) {
        $this->adapter->removeColumn($tableName, $columnName);
    }

    /**
     * Metodo para renomeiar uma coluna de uma tabela
     * 
     * @param string $tableName     nome da tabela
     * @param string $oldColumnName antigo nome da coluna
     * @param string $newColumnName novo nome da coluna
     */
    public function renameColumn($tableName, $oldColumnName, $newColumnName) {
        $this->adapter->renameColumn($tableName, $oldColumnName, $newColumnName);
    }

    /**
     * Metodo para adicionar uma chave estrangeira a uma tabela
     * 
     * @param type $fkname
     * @param type $table
     * @param type $tableTarget
     * @param type $column
     * @param type $columnTarget
     */
    public function reference($fkname, $table, $tableTarget, $column, $columnTarget) {
        $this->adapter->addReference($fkname, $table, $tableTarget, $column, $columnTarget);
    }

    /**
     * Metodo para remover uma tabela
     * 
     * @param string $tableName nome da tabela
     */
    public function dropTable($tableName) {
        $this->adapter->dropTable($tableName);
    }

    /**
     * Metodo para remover uma chave estrangeira se possivel
     * 
     * @param string $table nome tabela
     * @param type $fkname
     */
    public function removeReference($table, $fkname) {
        $this->adapter->removeReference($fkname, $table);
    }

    /**
     * Metodo para efetuar migração de dados
     * 
     * @param string $origin banco de dados de origem
     * @param array $destine banco de dados de destino
     * @return params dados de origem e destino
     */
    public function migrateData($origin, $destine) {
        return array($origin, $destine);
    }

}

?>
