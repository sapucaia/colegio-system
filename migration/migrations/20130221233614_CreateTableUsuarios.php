<?php

class CreateTableUsuarios extends MigracaoBase {
    
    public function up() {
        $t = $this->createTable("usuario");
        $t->column('date', 'data', $option = array('default' => 'now()'));
        $t->end();
    }

    public function down() {
        throw new Exception('Method down from CreateTableUsuarios not yet implemented');
    }
    
}

?>