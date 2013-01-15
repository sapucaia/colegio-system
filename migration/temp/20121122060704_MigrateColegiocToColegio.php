<?php

class MigrateColegiocToColegio extends MigracaoBase {

//    protected $bases = array('origin', 'destine');

    public function up() {
//        return $this->migrateData('origin', 'destine');
        $destine = array(
//            'destine'
            'destine' => array(null)
//            'destine' => array(
//                'usuarios'=>array("nome","paavo","LIKE"),
//                'regras',
//                'usuarioregras')
        );
//        $destine = array(
//            'origin' => array(
//                'usuarios',
//                'regras',
//                'usuario_regras')
//        );
//        return $this->migrateData($origin, 'destine');
        return $this->migrateData('origin', $destine);
    }

    public function down() {
        
    }

}

?>