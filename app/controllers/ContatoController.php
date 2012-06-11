<?php
#require_once 'conf/lock.php';

class ContatoController extends Controller {

    function _default() {
        $contatoRecord = new ContatoRecord();
        $todos = $contatoRecord->listar();
        $todos = serialize($todos);
        include('app/views/contato/index.php');
    }

    function _error() {
        #echo $this->Command;
    }

    function _novo() {
        include('app/views/contato/novo.php');
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