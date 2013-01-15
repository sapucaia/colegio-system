<?php

#require_once 'conf/lock.php';

class RootController extends Controller {

    function _default() {
//        $avisoRecord = new AvisoRecord();
//        $todosAvisos = $avisoRecord->listar();
//        $todosAvisos = serialize($todosAvisos);
        include "pagina.php";
    }

    function _error() {
        echo $this->Command;
    }

}
?>