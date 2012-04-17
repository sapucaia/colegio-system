<?php

/**
 * Description of Video
 *
 * @author Paavo Soeiro
 */
class Video {

  private $idVideo;
  private $titulo;
  private $url;

  public function __construct($idVideo, $titulo, $url) {
    $this->idVideo = $idVideo;
    $this->titulo = $titulo;
    $this->url = $url;
  }

  public function getIdVideo() {
    return $this->idVideo;
  }

  public function setIdVideo($idVideo) {
    $this->idVideo = $idVideo;
  }

  public function getTitulo() {
    return $this->titulo;
  }

  public function setTitulo($titulo) {
    $this->titulo = $titulo;
  }

  public function getUrl() {
    return $this->url;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

}

?>
