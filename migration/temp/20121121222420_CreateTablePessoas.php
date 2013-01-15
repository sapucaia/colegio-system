<?php

class CreateTablePessoas extends MigracaoBase {

    public $bases = array("colegio.computador",
        "colegio.livia-windows");

    public function up() {
        $t = $this->createTable('pessoas');
        $t->column('string', 'nome');
        $t->column('string', 'cpf', $options = array('size' => 13));
        $t->end();
    }

    public function down() {
        $this->dropTable('pessoas');
    }

}

?>