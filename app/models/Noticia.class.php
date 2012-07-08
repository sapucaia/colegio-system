<?php

/**
 * Description of Noticia
 *
 * @author Paavo Soeiro
 */
class Noticia {

    private $idNoticia;
    private $data;
    private $titulo;
    private $noticia;

    function __construct($idNoticia = null, $data = null, $titulo = null, $noticia = null) {
        $this->idNoticia = $idNoticia;
        $this->data = $data;
        $this->titulo = $titulo;
        $this->noticia = $noticia;
    }

    public function getIdNoticia() {
        return $this->idNoticia;
    }

    public function setIdNoticia($idNoticia) {
        $this->idNoticia = $idNoticia;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getNoticia() {
        return $this->noticia;
    }

    public function setNoticia($noticia) {
        $this->noticia = $noticia;
    }

}

?>
