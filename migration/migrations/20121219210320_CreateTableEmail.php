<?php

class CreateTableEmail extends MigracaoBase {

//    private $remetente;
//    private $email;
//    private $assunto;
//    private $mensagem;

    public function up() {
        $t = $this->createTable('email');
        $t->column('string', 'email');
        $t->column('string', 'assunto');
        $t->column('body', 'mensagem');
        $t->end();
    }

    public function down() {
        throw new Exception('Method down from CreateTableEmail not yet implemented');
    }

}

?>