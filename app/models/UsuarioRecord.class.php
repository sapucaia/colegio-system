<?php

/**
 * 
 * @author Paavo Soeiro
 * 
 */
class UsuarioRecord extends ManipulaBanco {

    private $usuarios;

    public function cadastrar($usuario) {
        $dados['nomecompleto'] = $usuario->getNomeCompleto();
        $dados['login'] = $usuario->getLogin();
        $dados['senha'] = $usuario->getSenha();
        $dados['tipousuario'] = $usuario->getTipoUsuario();
        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['IDUSUARIO']); $i++) {
            $this->usuarios[$i] = new Usuario($a['IDUSUARIO'][$i],
                            $a['NOMECOMPLETO'][$i],
                            $a['LOGIN'][$i],
                            null,
                            $a['DATACAD'][$i],
                            $a['TIPOUSUARIO'][$i],
                            $a['ULTIMOACESSO'][$i]);
        }
        return $this->usuarios;
    }

    public function getUsuarioPorLogin($login) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("login", "=", $login));
        $a = $this->selecionarColecao($criteria);
        $usuario = new Usuario($a['IDUSUARIO'][1],
                        $a['NOMECOMPLETO'][1],
                        $a['LOGIN'][1],
                        $a['SENHA'][1],
                        $a['DATACAD'][1],
                        $a['TIPOUSUARIO'][1],
                        $a['ULTIMOACESSO'][1]);
        return $usuario;
    }

    public function setUltimoAcesso($login) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("login", "=", $login));
        $a = $this->selecionarColecao($criteria);
        $a['ULTIMOACESSO'] = time();
        return $this->atualizar($a, $a['IDUSUARIO']);
    }

}

?>
