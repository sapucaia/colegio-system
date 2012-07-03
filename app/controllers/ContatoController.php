<?php
require_once 'conf/lock.php';

class ContatoController extends Controller {

    private $PATH;

    function ContatoController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/contato/";
        } else {
            $this->PATH = "../app/views/contato/";
        }
    }

    function _default() {

//        $contatoRecord = new ContatoRecord();
//        $todos = $contatoRecord->listar();
//        $todos = serialize($todos);

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
        $contato = new Contato;
        $contato->setContato($form['contato']);
        $contatoRecord = new ContatoRecord;
        if ($contatoRecord->cadastrar($contato)) {
            $str = 'Contato salvo com sucesso total!';
            $str = serialize($str);
            include ('app/views/contato/feedback.php');
        } else {
            $str = 'Erro! Contato não salvo';
            $str = serialize($str);
            include ('../../app/views/contato/feedback.php');
        }
    }

    function _mostrar() {
        $contatoRecord = new ContatoRecord;
        $todos = $contatoRecord->listar();
        $todos = serialize($todos);
        include('app/views/contato/mostrar.php');
    }

    function _editar() {
        $contatoRecord = new ContatoRecord;
        $aux = $this->Command->getParameters();
        $objeto = $contatoRecord->getContato($aux[0]);
        $objeto = serialize($objeto);
        include('app/views/contato/editar.php');
    }

    function _remover() {
        $form = $_POST;
        $contatoRecord = new ContatoRecord;
        if ($contatoRecord->removerContato($form['idcontato'])) {
            $str = 'Remo&ccedil;&atilde;o realizada com sucesso';
            $str = serialize($str);
            include ('app/views/contato/feedback.php');
        } else {
            $str = 'Falha ao tentar remover';
            $str = serialize($str);
            include ('app/views/contato/feedback.php');
        }
    }

    function _atualizar() {
        $form = $_POST;
        $contatoRecord = new ContatoRecord;
        $dados['contato'] = $form['contato'];
        if ($contatoRecord->atualizar($dados, $form['idcontato'])) {
            $str = 'Atualiza&ccedil;&atilde;o realizada com sucesso ';
            $str = serialize($str);
            include ('app/views/contato/feedback.php');
        } else {
            $str = 'Falha ao tentar atualizar';
            $str = serialize($str);
            include ('app/views/contato/feedback.php');
        }
    }

}
?>