<?php

/**
 * Description of EmailRecord
 *
 * @author Wallace Veridiano
 */
class EmailRecord extends ManipulaBanco {

    private $email;

    public function cadastrar($email) {
        $dados['remetente'] = $email->getRemetente();
        $dados['email'] = $email->getEmail();
        $dados['assunto'] = $email->getAssunto();
        $dados['mensagem'] = $email->getMensagem();
        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['IDCONTATO']); $i++) {
            $this->emails[$i] = new Email($a['IDCONTATO'][$i],
                            $a['REMETENTE'][$i],
                            $a['EMAIL'][$i],
                            $a['ASSUNTO'][$i],
                            $a['MENSAGEM'][$i]);
        }
        return $this->emails;
    }

    public function getEmail($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("idemail", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $email = new Email($a['IDCONTATO'][$i],
                        $a['REMETENTE'][$i],
                        $a['EMAIL'][$i],
                        $a['ASSUNTO'][$i],
                        $a['MENSAGEM'][$i]);
    }

    public function removerEmail($id) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter("idemail", "=", $id));
        $this->deletar($criteria);
        return true;
    }

}

?>