<?php

/**
 * Description of NoticiaController
 *
 * @author Paavo Soeiro
 */
class NoticiaController extends Controller {

    private $PATH;

    function AvisoController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/noticia/";
        } else {
            $this->PATH = "../app/views/noticia/";
        }
    }

    function _default() {

        $noticiaRecord = new NoticiaRecord();
        $todos = $noticiaRecord->listar();
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
        $noticia = new Noticia();
        $noticia->setNoticia($form['noticia']);
        $noticia->setTitulo($form['titulo']);
        $noticiaRecord = new NoticiaRecord();
        $noticiaRecord->cadastrar($noticia);
    }

    function _mostrar() {
        include($this->PATH . 'mostrar.php');
    }

    function _editar() {
        include($this->PATH . 'editar.php');
    }

    function _remover() {
        
    }

}

?>
