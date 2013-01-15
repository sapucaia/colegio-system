<?php

class CreateTableFoto extends MigracaoBase {

//    private $idFoto;
//    private $idGaleria;
//    private $nome;
//    private $url;
//    private $dataFoto;
//    private $descricao;
//    private $thumbnail;

    public function up() {
        $t = $this->createTable('foto');
        $t->column('string', 'nome');
        $t->column('string', 'url');
        $t->column('date', 'dataFoto');
        $t->column('body', 'descricao');
        $t->column('string', 'thumbnail');
        $t->reference('galeria');
        $t->end();
    }

    public function down() {
        throw new Exception('Method down from CreateTableFoto not yet implemented');
    }

}

?>