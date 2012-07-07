<?php
require_once 'conf/lock.php';

class EmailController extends Controller {

    private $PATH;

    function EmailController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/email/";
        } else {
            $this->PATH = "../app/views/email/";
        }
    }

    function _default() {

//        $emailRecord = new EmailRecord();
//        $todos = $emailRecord->listar();
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
        $email = new Email;
        $email->setRemetente($form['remetente']);
        $email->setEmail($form['email']);
        $email->setAsssunto($form['assunto']);
        $email->setMensagem($form['mensagem']);
        $emailRecord = new EmailRecord;
        if ($emailRecord->cadastrar($email)) {
            $str = 'Email salvo com sucesso total!';
            $str = serialize($str);
            include ('app/views/email/feedback.php');
        } else {
            $str = 'Erro! Email não salvo';
            $str = serialize($str);
            include ('../../app/views/email/feedback.php');
        }
    }

    function _mostrar() {
        $emailRecord = new EmailRecord;
        $todos = $emailRecord->listar();
        $todos = serialize($todos);
        include('app/views/email/mostrar.php');
    }

    function _editar() {
        $emailRecord = new EmailRecord;
        $aux = $this->Command->getParameters();
        $objeto = $emailRecord->getEmail($aux[0]);
        $objeto = serialize($objeto);
        include('app/views/email/editar.php');
    }

    function _remover() {
        $form = $_POST;
        $emailRecord = new EmailRecord;
        if ($emailRecord->removerEmail($form['idemail'])) {
            $str = 'Remo&ccedil;&atilde;o realizada com sucesso';
            $str = serialize($str);
            include ('app/views/email/feedback.php');
        } else {
            $str = 'Falha ao tentar remover';
            $str = serialize($str);
            include ('app/views/email/feedback.php');
        }
    }

}
?>