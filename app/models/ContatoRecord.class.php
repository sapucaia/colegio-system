<?php

/**
 * Description of ContatoRecord
 *
 * @author Wallace Veridiano
 */
class ContatoRecord extends ManipulaBanco {

    private $contato;

    public function cadastrar($contato) {
        $dados['remetente'] = $contato->getRemetente();
        $dados['email'] = $contato->getEmail();
        $dados['assunto'] = $contato->getAssunto();
        $dados['mensagem'] = $contato->getMensagem();
        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['IDCONTATO']); $i++) {
            $this->contatos[$i] = new Contato($a['IDCONTATO'][$i],
                            $a['REMETENTE'][$i],
                            $a['EMAIL'][$i],
                            $a['ASSUNTO'][$i],
                            $a['MENSAGEM'][$i]);
        }
        return $this->contatos;
    }

    public function getContato($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("idcontato", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $contato = new Contato($a['IDCONTATO'][$i],
                        $a['REMETENTE'][$i],
                        $a['EMAIL'][$i],
                        $a['ASSUNTO'][$i],
                        $a['MENSAGEM'][$i]);
    }

    public function removerContato($id) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter("idcontato", "=", $id));
        $this->deletar($criteria);
        return true;
    }

}

?>
