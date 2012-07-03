<?php
require_once 'conf/lock.php';

class RecadoController extends Controller {

    private $PATH;

    function RecadoController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/recado/";
        } else {
            $this->PATH = "../app/views/recado/";
        }
    }

    function _default() {

        $recadoRecord = new RecadoRecord();
        $todos = $recadoRecord->listar();
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
        $recado = new Recado();
        $recado->setRemetente($form['remetente']);
        $recado->setDestinatario($form['destinatario']);
        $recado->setMensagem($form['mensagem']);
        $recadoRecord = new RecadoRecord;
        if ($recadoRecord->cadastrar($recado)) {
            $str = 'Recado salvo com sucesso total!';
            $str = serialize($str);
            include ('app/views/recado/feedback.php');
        } else {
            $str = 'Erro! Recado não salvo';
            $str = serialize($str);
            include ('app/views/recado/feedback.php');
        }
    }

    function _mostrar() {
        $recadoRecord = new RecadoRecord;
        $todos = $recadoRecord->listar();
        $todos = serialize($todos);
        include('app/views/recado/mostrar.php');
    }

    function _remover() {
        $form = $_POST;
        $recadoRecord = new RecadoRecord;
        if ($recadoRecord->removerRecado($form['idrecado'])) {
            $str = 'Remo&ccedil;&atilde;o realizada com sucesso';
            $str = serialize($str);
            include ('app/views/recado/feedback.php');
        } else {
            $str = 'Falha ao tentar remover';
            $str = serialize($str);
            include ('app/views/recado/feedback.php');
        }
    }

    function _editar() {
        $recadoRecord = new RecadoRecord;
        $aux = $this->Command->getParameters();
        $objeto = $recadoRecord->getRecado($aux[0]);

        $objeto = serialize($objeto);
        include('app/views/recado/editar.php');
    }

    function _liberar() {
        
            $form = $_POST;
            $recadoRecord = new RecadoRecord;
            if ($recadoRecord->atualizar($form, $form['idrecado'])) {
                $str = "Recado liberado com sucesso";
                $str = serialize($str);
                include ('app/views/recado/feedback.php');
            } else { 
                $str = "Erros t&eacutecnicos";
                $str = serialize($str);
                include ('app/views/recado/feedback.php');
            }
        }
}
?>
