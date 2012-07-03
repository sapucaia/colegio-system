<?php

/**
 * Description of Recado
 *
 * @author Livia Correia
 */
class Recado {

  private $idRecado;
  private $remetente;
  private $destinatario;
  private $dataHora;
  private $mensagem;
  private $status;

  function __construct($idRecado, $remetente, $destinatario, $dataHora, $mensagem, $status) {
      $this->idRecado = $idRecado;
      $this->remetente = $remetente;
      $this->destinatario = $destinatario;
      $this->dataHora = $dataHora;
      $this->mensagem = $mensagem;
      $this->status = $status;
  }

  public function getIdRecado() {
      return $this->idRecado;
  }

  public function setIdRecado($idRecado) {
      $this->idRecado = $idRecado;
  }

  public function getRemetente() {
      return $this->remetente;
  }

  public function setRemetente($remetente) {
      $this->remetente = $remetente;
  }

  public function getDestinatario() {
      return $this->destinatario;
  }

  public function setDestinatario($destinatario) {
      $this->destinatario = $destinatario;
  }

  public function getDataHora() {
      return $this->dataHora;
  }

  public function setDataHora($dataHora) {
      $this->dataHora = $dataHora;
  }

  public function getMensagem() {
      return $this->mensagem;
  }

  public function setMensagem($mensagem) {
      $this->mensagem = $mensagem;
  }

  public function getStatus() {
      return $this->status;
  }

  public function setStatus($status) {
      $this->status = $status;
  }


}

?>
