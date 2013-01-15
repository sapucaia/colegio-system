<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Foto
 *
 * @author Paavo Soeiro
 */
class Foto {

    private $idFoto;
    private $idGaleria;
    private $nome;
    private $url;
    private $dataFoto;
    private $descricao;
    private $thumbnail;

    function __construct($idFoto = null, $idGaleria = null, $nome = null, $url = null, $dataFoto = null, $descricao = null, $thumbnail = null) {
        $this->idFoto = $idFoto;
        $this->idGaleria = $idGaleria;
        $this->nome = $nome;
        $this->url = $url;
        $this->dataFoto = $dataFoto;
        $this->descricao = $descricao;
        $this->thumbnail = $thumbnail;
    }

    public function getIdFoto() {
        return $this->idFoto;
    }

    public function setIdFoto($idFoto) {
        $this->idFoto = $idFoto;
    }

    public function getIdGaleria() {
        return $this->idGaleria;
    }

    public function setIdGaleria($idGaleria) {
        $this->idGaleria = $idGaleria;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDataFoto() {
        return $this->dataFoto;
    }

    public function setDataFoto($dataFoto) {
        $this->dataFoto = $dataFoto;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getThumbnail() {
        return $this->thumbnail;
    }

    public function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
    }

}

?>
