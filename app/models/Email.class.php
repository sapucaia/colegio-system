<?php

/**
 * Description of Email
 *
 * @author Paavo Soeiro
 */
class Email {

    private $idEmail;
    private $remetente;
    private $email;
    private $assunto;
    private $mensagem;

    public function __construct($idEmail, $remetente, $email, $assunto, $mensagem) {
        $this->idEmail = $idEmail;
        $this->remetente = $remetente;
        $this->email = $email;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    public function getIdEmail() {
        return $this->idEmail;
    }

    public function setIdEmail($idEmail) {
        $this->idEmail = $idEmail;
    }

    public function getRemetente() {
        return $this->remetente;
    }

    public function setRemetente($remetente) {
        $this->remetente = $remetente;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAssunto() {
        return $this->assunto;
    }

    public function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

}

?>
