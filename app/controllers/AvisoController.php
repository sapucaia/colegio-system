<?php
require_once 'conf/lock.php';

class AvisoController extends Controller {

    function _default() {
        $avisoRecord = new AvisoRecord();
        $todos = $avisoRecord->listar();
        $todos = serialize($todos);
        include('app/views/aviso/index.php');
    }

    function _error() {
        #echo $this->Command;
    }

    function _novo() {
        include('app/views/aviso/novo.php');
    }

    function _salvar() {
        $form = $_POST;
        foreach ($form as $campo) {
            $campo = strip_tags($campo);
        }
        $aviso = new Aviso();
        $aviso->setAviso($form['aviso']);
        $avisoRecord = new AvisoRecord();
        $avisoRecord->cadastrar($aviso);
    }

    function _mostrar() {
        include('app/views/aviso/mostrar.php');
    }

    function _editar() {
        include('app/views/aviso/editar.php');
    }

    function _remover() {
        
    }

}
?>