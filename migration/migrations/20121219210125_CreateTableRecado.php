<?php

class CreateTableRecado extends MigracaoBase {

    public function up() {
        $t = $this->createTable('recado');
        $t->column('string', 'remetente');
        $t->column('string', 'destinatario');
        $t->column('timestamp', 'dataHora');
        $t->column('body', 'mensagem');
        $t->column('int', 'status');
        $t->end();
    }

    public function down() {
        $this->dropTable('recado');
    }

}

?>