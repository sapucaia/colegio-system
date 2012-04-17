<?php

/**
 * Description of Aviso
 *
 * @author Paavo Soeiro
 */
class Aviso {

  private $idAviso;
  private $data;
  private $aviso;

  public function __construct($idAviso, $data, $aviso) {
    $this->idAviso = $idAviso;
    $this->data = $data;
    $this->aviso = $aviso;
  }

  public function getIdAviso() {
    return $this->idAviso;
  }

  public function setIdAviso($idAviso) {
    $this->idAviso = $idAviso;
  }

  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function getAviso() {
    return $this->aviso;
  }

  public function setAviso($aviso) {
    $this->aviso = $aviso;
  }

}

?>
