<?php

class AddReferencePessoaToUsuarios extends MigracaoBase {

    public $bases = array("colegio.computador",
        "colegio.livia-windows");

    public function up() {
        $this->addColumn('usuarios', 'pessoa_id', 'int');
        $this->reference('fk_usuario_pessoa', 'usuarios', 'pessoas', 'pessoa_id', 'id');
    }

    public function down() {
        $this->removeReference('usuarios', 'fk_usuario_pessoa');
        $this->removeColumn('usuarios', 'pessoa_id');
    }

}

?>