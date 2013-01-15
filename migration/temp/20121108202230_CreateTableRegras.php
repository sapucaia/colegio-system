<?php

require_once '../MigracaoBase.php';

/**
 * Description of CreateTableRegras
 *
 * @author Paavo Soeiro
 */
class CreateTableRegras extends MigracaoBase {

    public $bases = array("colegio.computador",
        "colegio.livia-windows");

    public function down() {
        $this->dropTable('regras');
    }

    public function up() {
        $t = $this->createTable('regras');
        $t->column('string', "descricao");
        $t->end();
    }

}

?>
