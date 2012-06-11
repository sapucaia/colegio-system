<?php

#require_once 'conf/lock.php';

class LoginController extends Controller {

    function _default() {
        
    }

    function _error() {
        #echo $this->Command;
    }

    function _logar() {
        $usuarioRecord = new UsuarioRecord();
        $usuario = $usuarioRecord->getUsuarioPorLogin($_POST['login']);
        $senha = $_POST['senha'];
        $senha = sha1(trim($senha));
        if ($usuario->getSenha() === $senha) {
            $usuarioRecord->setUltimoAcesso($usuario);
            $_SESSION['usuario'] = serialize($usuario);
            echo 'LOGOU';
            header('Location: ../admin');
            return true;
        } else {
            header('Location: ../login');
            return false;
        }
    }

    function _logout() {
        unset($_SESSION['usuario']);
        session_destroy();
        header('Location: ../login');
    }

}

?>