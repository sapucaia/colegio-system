<?php

require_once 'conf/lock.php';

class LoginController extends Controller {

    function _default() {
        
    }

    function _error() {
        #echo $this->Command;
    }

    function _login() {
        $usuarioRecord = new UsuarioRecord();
        $usuario = $usuarioRecord->getUsuarioPorLogin($_POST['login']);
        $senha = $_POST['senha'];
        $senha = sha1(trim($senha));
        if ($usuario->getSenha() === $senha) {
            $usuarioRecord->setUltimoAcesso($login);
            $_SESSION['usuario'] = serialize($usuario);
            return true;
        } else {
            return false;
        }
    }

    function _logout() {
        session_unregister($_SESSION['usuario']);
        session_destroy();
    }

}

?>