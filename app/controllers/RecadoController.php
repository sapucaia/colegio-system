<?php
require_once 'conf/lock.php';

class RecadoController extends Controller {

    function _default() {
        $recadoRecord = new RecadoRecord();
        $todos = $recadoRecord->listar();
        $todos = serialize($todos);
        include('app/views/recado/index.php');
    }

    function _error() {
        #echo $this->Command;
    }

    function _novo() {
        include('app/views/recado/novo.php');
    }

    function _salvar() {
        $form = $_POST;
        foreach ($form as $campo) {
            $campo = strip_tags($campo);
        }
    }

    function _mostrar() {
        
    }

    function _editar() {
        
    }

    function _remover() {
        
    }

}
?>