<?php

require_once 'conf/lock.php';

class UsuarioController extends Controller {

    function _default() {
        $usuarioRecord = new UsuarioRecord();
        $todos = $usuarioRecord->listar();
        $todos = serialize($todos);
        include('app/views/usuario/index.php');
    }

    function _error() {
        #echo $this->Command;
    }

    function _novo() {
        include('app/views/usuario/novo.php');
    }

    function _salvar() {
        $form = $_POST;
        foreach ($form as $campo) {
            $campo = strip_tags($campo);
        }
        $usuario = new Usuario();
        $usuario->setNomeCompleto($form['nomecompleto']);
        $usuario->setLogin($form['login']);
        $usuario->setSenha(sha1(trim($form['senha'])));
        $usuario->setTipoUsuario($form['tipousuario']);
        $usuarioRecord = new UsuarioRecord();
        if ($usuarioRecord->cadastrar($usuario)) {
            echo 'SALVO';
        } else {
            echo 'NAO SALVO';
        }
    }

    function _mostrar() {
        include('app/views/usuario/mostrar.php');
    }

    function _editar() {
        include('app/views/usuario/editar.php');
    }

    function _remover() {
        
    }

}

?>