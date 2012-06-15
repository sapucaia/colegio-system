<?php

/**
 * Description of Usuario
 *
 * @author Paavo Soeiro
 */
class Usuario {

    private $idUsuario;
    private $nomeCompleto;
    private $login;
    private $senha;
    private $dataCad;
    private $tipoUsuario;
    private $ultimoAcesso;

    function __construct($idUsuario = null, $nomeCompleto = null, $login = null, 
            $senha = null, $dataCad = null, $tipoUsuario = null, $ultimoAcesso = null) {
        $this->idUsuario = $idUsuario;
        $this->nomeCompleto = $nomeCompleto;
        $this->login = $login;
        $this->senha = $senha;
        $this->dataCad = $dataCad;
        $this->tipoUsuario = $tipoUsuario;
        $this->ultimoAcesso = $ultimoAcesso;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    public function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getDataCad() {
        return $this->dataCad;
    }

    public function setDataCad($dataCad) {
        $this->dataCad = $dataCad;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getUltimoAcesso() {
        return $this->ultimoAcesso;
    }

    public function setUltimoAcesso($ultimoAcesso) {
        $this->ultimoAcesso = $ultimoAcesso;
    }

}

?>
