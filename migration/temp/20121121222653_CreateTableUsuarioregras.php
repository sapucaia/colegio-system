<?php

class CreateTableUsuarioregras extends MigracaoBase {

    public $bases = array("colegio.computador",
        "colegio.livia-windows");

    public function up() {
        $t = $this->createTable('usuarioregras', $options = array('id' => false));
        $t->reference('usuarios');
        $t->reference('regras');
        $t->end();
    }

    public function down() {
        $this->dropTable('usuarioregras');
    }

}

?>