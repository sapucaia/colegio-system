<?php

//require_once 'ITableDefinition.php';

/**
 * Description of TableDefinition
 *
 * @author Paavo Soeiro
 */
abstract class TableDefinition implements ITableDefinition {

    protected $adapter;
    protected $columns;
    protected $sql = "";
    protected $name;
    protected $auto_generate_id = true;
    protected $update = true;

    /**
     * 
     * @param type $adapter
     * @param type $tableName
     * @param type $options
     * @throws TableNameNotDefinedException
     * @throws AdapterNotDefinedException
     */
    public function __construct(IMigrationAdapter $adapter, $tableName, $options) {
        if ($tableName == null || $tableName === "")
            throw new TableNameNotDefinedException();
        if ($adapter == null || $adapter === "")
            throw new AdapterNotDefinedException();

        $this->name = $tableName;
        $this->adapter = $adapter;

        if (array_key_exists('id', $options)) {
            if ($options['id'] == false)
                $this->auto_generate_id = false;
        }
    }

    public function skipUpdateSchema() {
        $this->update = false;
    }

}

?>
