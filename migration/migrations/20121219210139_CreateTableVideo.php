<?php

class CreateTableVideo extends MigracaoBase {
//    rivate $idVideo;
//  private $titulo;
//  private $url;

    public function up() {
        $t = $this->createTable('video');
        $t->column('string', 'titulo');
        $t->column('string', 'url');
        $t->end();
    }

    public function down() {
        throw new Exception('Method down from CreateTableVideo not yet implemented');
    }
    
}

?>