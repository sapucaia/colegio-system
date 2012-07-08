<?php

class NoticiaController extends Controller {

    private $PATH;

    function NoticiaController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/noticia/";
        } else {
            $this->PATH = "../app/views/noticia/";
        }
    }

    function _default() {

        $noticiaRecord = new NoticiaRecord;
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
        $noticia = new Noticia;
        $noticia->setTitulo($form['titulo']);
        $noticia->setNoticia($form['noticia']);
        $noticiaRecord = new NoticiaRecord;
        if($noticiaRecord->cadastrar($noticia)){
            $str = 'Noticia salva com sucesso total!';
            $str = serialize($str);
            include ('app/views/noticia/feedback.php');
        }  else {
            $str = 'Erro! Noticia não salva';
            $str = serialize($str);
            include ('../../app/views/noticia/feedback.php');
        }
    }

    function _mostrar() {
        $noticiaRecord = new NoticiaRecord;
        $todos = $noticiaRecord->listar();
        $todos = serialize($todos);
        include('app/views/noticia/mostrar.php');
    }

      function _editar() {
        $noticiaRecord = new NoticiaRecord;
        $aux = $this->Command->getParameters();
        $objeto = $noticiaRecord->getNoticia($aux[0]);
        $objeto = serialize($objeto);
//        print_r($objeto);
        include('app/views/noticia/editar.php'); 
    }


    function _remover() {
        $form = $_POST;
        $noticiaRecord  = new NoticiaRecord;

        if($noticiaRecord->removerNoticia($form['idnoticia'])){
            $str = 'Remo&ccedil;&atilde;o de noticia realizada com sucesso';
            $str = serialize($str);
            include ('app/views/noticia/feedback.php');
        }  else {
            $str = 'Falha ao tentar remover a noticia';
            $str = serialize($str);
            include ('app/views/noticia/feedback.php');
        }
        
    }
    
    function _atualizar(){
        $form = $_POST;
//        print_r($form);
        $noticiaRecord = new NoticiaRecord();
        $dados['noticia'] = $form['noticia'];
        if($noticiaRecord->atualizar($dados, $form['idnoticia'])){
            $str = 'Atualiza&ccedil;&atilde;o de noticia realizada com sucesso ';
            $str = serialize($str);
            include ('app/views/noticia/feedback.php');
        }  else {
            $str = 'Falha ao tentar atualizar';
            $str = serialize($str);
            include ('app/views/noticia/feedback.php');
        }
                
        
    }

}
?>