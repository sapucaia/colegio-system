<?php

class CreateTableUsuarios extends MigracaoBase {

    private $idUsuario;
    private $nomeCompleto;
    private $login;
    private $senha;
    private $dataCad;
    private $tipoUsuario;
    private $ultimoAcesso;

    public function up() {
        $t = $this->createTable("usuario");
        $t->column('string', 'nomeCompleto');
        $t->column('string', 'login');
        $t->column('string', 'senha');
//        $t->column('string', 'nomeCompleto');
        $t->column('date', 'dataCad', $option = array('default' => 'now()'));
        $t->column('int', 'tipoUsuario');
        $t->column('date', 'ultimoAcesso');
        $t->end();
    }

    public function down() {
        $this->dropTable("usuario");
    }

}

?>