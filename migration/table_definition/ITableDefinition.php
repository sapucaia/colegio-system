<?php

/**
 *
 * @author Lorrane
 */
interface ITableDefinition {
    //put your code here
    public function column($type, $columnName, $options = array());
    public function reference($tableTarget, $column, $columnTarget = null);

    public function end();
}

?>
