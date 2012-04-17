<?php

/**
 * Description of Contato
 *
 * @author Paavo Soeiro
 */
class Contato {
  private $idContato;
  private $remetente;
  private $email;
  private $assunto;
  private $mensagem;
  
  public function __construct($idContato, $remetente, $email, $assunto, $mensagem) {
    $this->idContato = $idContato;
    $this->remetente = $remetente;
    $this->email = $email;
    $this->assunto = $assunto;
    $this->mensagem = $mensagem;
  }

  public function getIdContato() {
    return $this->idContato;
  }

  public function setIdContato($idContato) {
    $this->idContato = $idContato;
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
