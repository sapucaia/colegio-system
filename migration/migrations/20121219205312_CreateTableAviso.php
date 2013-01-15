<?php

class CreateTableAviso extends MigracaoBase {

    // idaviso integer NOT NULL,
    //data timestamp without time zone DEFAULT now() NOT NULL,
    //aviso text NOT NULL
    public function up() {
        $t = $this->createTable('aviso');
        $t->column('date', 'data', $option = array('default' => 'now()'));
        $t->column('body', 'aviso');
        $t->end();
    }

    public function down() {
        $this->dropTable('aviso');
    }

}

?>