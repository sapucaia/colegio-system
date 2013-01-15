<?php

class CreateTableNoticia extends MigracaoBase {

//       private $idNoticia;
//    private $dataNoticia;
//    private $titulo;
//    private $noticia;
    public function up() {
        $t = $this->createTable('noticia');
        $t->column('date', 'dataNoticia');
        $t->column('string', 'titulo');
        $t->column('body', 'noticia');
        $t->end();
    }

    public function down() {
        throw new Exception('Method down from CreateTableNoticia not yet implemented');
    }

}

?>