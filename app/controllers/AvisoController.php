<?php

class AvisoController extends Controller {

    private $PATH;

    function AvisoController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/aviso/";
        } else {
            $this->PATH = "../app/views/aviso/";
        }
    }

    function _default() {

        $avisoRecord = new AvisoRecord();
        $todos = $avisoRecord->listar();
        $todos = serialize($todos);

        include($this->PATH . 'index.php');
    }

    function _error() {
        #echo $this->Command;
    }

    function _novo() {
        include($this->PATH . 'novo.php');
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