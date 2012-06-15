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
        $avisoRecord = new AvisoRecord();
        $todos = $avisoRecord->listar();
        $todos = serialize($todos);
        include('app/views/aviso/mostrar.php');
    }

      function _editar() {
        $avisoRecord = new AvisoRecord;
        $aux = $this->Command->getParameters();
        $objeto = $avisoRecord->getAviso($aux[0]);
        $objeto = serialize($objeto);
//        print_r($objeto);
        include('app/views/aviso/editar.php'); 
    }


    function _remover() {
        
    }
    
    function _atualizar(){
        $form = $_POST;
//        print_r($form);
        $avisoRecord = new AvisoRecord;
        $dados['aviso'] = $form['aviso'];
        if($avisoRecord->atualizar($dados, $form['idaviso'])){
            echo 'Atualiza&ccedil;&atilde;o realizada com sucesso ';
        }  else {
            echo 'Falha ao tentar atualizar';
        }
                
        
    }

}
?>