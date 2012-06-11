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
            $usuarioRecord->setUltimoAcesso($usuario);
            $_SESSION['usuario'] = serialize($usuario);
            header('Location: ../admin');
            return true;
        } else {
            echo 'USUARIO OU SENHA INCORRETOS';
            return false;
        }
    }

    function _logout() {
        session_unregister($_SESSION['usuario']);
        session_destroy();
    }

}

?>