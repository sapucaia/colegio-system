<?php

/**
 * Description of ContatoRecord
 * 
 * @author Paavo Soeiro
 */
class ContatoRecord extends ManipulaBanco {

    public function cadastrar($contato) {
        $dados['remetente'] = $contato->getRemetente();
        $dados['email'] = $contato->getEmail();
        $dados['assunto'] = $contato->getAssunto();
        $dados['mensagem'] = $contato->getMensagem();
        return $this->salvar($dados);
    }

}

?>
