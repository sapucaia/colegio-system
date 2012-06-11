<?php
#require_once 'conf/lock.php';

class VideoController extends Controller {

    function _default() {
        $videoRecord = new VideoRecord();
        $todos = $videoRecord->listar();
        $todos = serialize($todos);
        include('app/views/video/index.php');
    }

    function _error() {
        #echo $this->Command;
    }

    function _novo() {
        include('app/views/video/novo.php');
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