<?php

/**
 * Description of TSqlCreate
 *
 * @author Paavo Soeiro
 */
class TSqlCreate extends TSqlInstruction {

    protected $columns = array();
    protected $references;

    /*
     * chave estrangeira
     * nome, tabela_alvo, coluna_local, coluna_indice
     * usando como convensao chave primaria = id
     *                       chave estrangeira = tabela_id
     * 
     */

    public function column($column) {
        
    }

    public function addForeignKey($name, $column, $table = null, $index = null) {
        if ($table == null)
            $table = $this->getEntity();
        if ($index == null)
            $index = $this->columns["id"];
        $this->references[$name] = array($table, $column, $index);
    }

    public function getInstruction() {
        $this->sql = "CREATE TABLE ";

        /*
         * CREATE TABLE $tabela
         *  $columns[$i] NOT NULL PRIMARY
         */
    }

}

?>
