<?php

class CreateTableGaleria extends MigracaoBase {

//    private $idGaleria;
//    private $nomeGaleria;
//    private $dataGaleria;
//    private $capa;

    public function up() {
        $t = $this->createTable('galeria');
        $t->column('string', 'nomeGaleria');
        $t->column('date', 'dataGaleria');
        $t->column('string', 'capa');
        $t->end();
    }

    public function down() {
        throw new Exception('Method down from CreateTableGaleria not yet implemented');
    }

}

?>