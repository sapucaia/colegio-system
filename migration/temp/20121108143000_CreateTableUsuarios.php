<?php

require_once '../MigracaoBase.php';

/**
 * Description of CreateTableUsuarios
 *
 * @author Paavo Soeiro
 */
class CreateTableUsuarios extends MigracaoBase {

    public $bases = array("colegio.computador",
        "colegio.livia-windows");

    public function down() {
        $this->dropTable('usuarios');
    }

    public function up() {
        $t = $this->createTable('usuarios');
        $t->column('string', 'nome');
        $t->end();
    }

}

?>
