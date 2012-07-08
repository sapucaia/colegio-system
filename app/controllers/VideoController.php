<?php
#require_once 'conf/lock.php';

class VideoController extends Controller {

    private $PATH;

    function VideoController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/video/";
        } else {
            $this->PATH = "../app/views/video/";
        }
    }

    function _default() {

        $videoRecord = new VideoRecord;
        $todos = $videoRecord->listar();
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
        $video = new Video;
        $video->setTitulo($form['titulo']);
        $video->setUrl($form['url']);
        $videoRecord = new VideoRecord;
        if ($videoRecord->cadastrar($video)) {
            $str = 'V&iacute;deo salvo com sucesso total!';
            $str = serialize($str);
            include ('app/views/video/feedback.php');
        } else {
            $str = 'Erro! V&iacute não salvo';
            $str = serialize($str);
            include ('../../app/views/video/feedback.php');
        }
    }

    function _mostrar() {
        $videoRecord = new VideoRecord;
        $todos = $videoRecord->listar();
        $todos = serialize($todos);
        include('app/views/video/mostrar.php');
    }

    function _editar() {
        $videoRecord = new VideoRecord;
        $aux = $this->Command->getParameters();
        $objeto = $videoRecord->getVideo($aux[0]);
        $objeto = serialize($objeto);
//        print_r($objeto);
        include('app/views/video/editar.php');
    }

    function _remover() {
        $form = $_POST;
        $videoRecord = new VideoRecord;

        if ($videoRecord->removerVideo($form['idvideo'])) {
            $str = 'Remo&ccedil;&atilde;o de v&iacute;deo realizado com sucesso';
            $str = serialize($str);
            include ('app/views/video/feedback.php');
        } else {
            $str = 'Falha ao tentar remover o v&iacute;deo';
            $str = serialize($str);
            include ('app/views/video/feedback.php');
        }
    }

    function _atualizar() {
        $form = $_POST;
//        print_r($form);
        $videoRecord = new VideoRecord;
        $dados['video'] = $form['video'];
        if ($videoRecord->atualizar($dados, $form['idvideo'])) {
            $str = 'Atualiza&ccedil;&atilde;o de v$iacute;deo realizado com sucesso ';
            $str = serialize($str);
            include ('app/views/video/feedback.php');
        } else {
            $str = 'Falha ao tentar atualizar';
            $str = serialize($str);
            include ('app/views/video/feedback.php');
        }
    }

}
?>