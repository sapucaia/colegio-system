<?php

/**
 * Description of ColumnDefinition
 *
 * @author Paavo Soeiro
 */
class ColumnDefinition {

    private $adapter;
    public $name;
    public $type;
    public $options = array();

    function __construct($adapter, $name, $type, $options) {
        $this->adapter = $adapter;
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;
    }

    public function getSql() {
        $sql = sprintf("%s %s", $this->name, $this->adapter->getType($this->type));
        $sql .= $this->adapter->addOptions($this->adapter->getType($this->type), $this->options);
        return $sql;
    }

}

?>
