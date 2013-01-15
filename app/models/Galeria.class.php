<?php

/**
 * Description of Galeria
 *
 * @author Paavo Soeiro
 */
class Galeria {

    private $idGaleria;
    private $nomeGaleria;
    private $dataGaleria;
    private $capa;

    function __construct($id = null, $nomeGaleria = null, $dataGaleria = null, $capa=null) {
        $this->idGaleria = $id;
        $this->nomeGaleria = $nomeGaleria;
        $this->dataGaleria = $dataGaleria;
        $this->capa = $capa;
    }

    public function getId() {
        return $this->idGaleria;
    }

    public function setId($id) {
        $this->idGaleria = $id;
    }

    public function getNomeGaleria() {
        return $this->nomeGaleria;
    }

    public function setNomeGaleria($nomeGaleria) {
        $this->nomeGaleria = $nomeGaleria;
    }

    public function getDataGaleria() {
        return $this->dataGaleria;
    }

    public function setDataGaleria($dataGaleria) {
        $this->dataGaleria = $dataGaleria;
    }

    public function getIdGaleria() {
        return $this->idGaleria;
    }

    public function setIdGaleria($idGaleria) {
        $this->idGaleria = $idGaleria;
    }

    public function getCapa() {
        return $this->capa;
    }

    public function setCapa($capa) {
        $this->capa = $capa;
    }

    public function __toString() {
        return $this->nomeGaleria;
    }

}

?>
