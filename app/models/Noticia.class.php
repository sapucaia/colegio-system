<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Noticia {

    private $idNoticia;
    private $dataNoticia;
    private $titulo;
    private $noticia;

    function __construct($idNoticia, $dataNoticia, $titulo, $noticia) {
        $this->idNoticia = $idNoticia;
        $this->dataNoticia = $dataNoticia;
        $this->titulo = $titulo;
        $this->noticia = $noticia;
    }

    public function getIdNoticia() {
        return $this->idNoticia;
    }

    public function setIdNoticia($idNoticia) {
        $this->idNoticia = $idNoticia;
    }

    public function getDataNoticia() {
        return $this->dataNoticia;
    }

    public function setDataNoticia($dataNoticia) {
        $this->dataNoticia = $dataNoticia;
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