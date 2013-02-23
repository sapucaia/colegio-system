<?php

class RecadoRecord extends ManipulaBanco {

    private $recados;

    public function cadastrar($recado) {
        $dados['remetente'] = $recado->getRemetente();
        $dados['destinatario'] = $recado->getDestinatario();
        $dados['mensagem'] = $recado->getMensagem();
        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['ID']); $i++) {
            $this->recados[$i] = new Recado($a['ID'][$i],
                            $a['REMETENTE'][$i],
                            $a['DESTINATARIO'][$i],
                            $a['DATA'][$i],
                            $a['MENSAGEM'][$i],
                            $a['STATUS'][$i]);
        }
        return $this->recados;
    }

    public function getRecado($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("id", "=", $id));
        $a = $this->selecionarColecao($criteria);
//        print_r($a);
        return $recado = new Recado($a['ID'][1],
                        $a['REMETENTE'][1],
                        $a['DESTINATARIO'][1],
                        $a['DATA'][1],
                        $a['MENSAGEM'][1],
                        $a['STATUS'][1]);
    }

    public function removerRecado($id) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter("id", "=", $id));
        $this->deletar($criteria);
        return true;
    }
}

?>
