<?php

/**
 * Description of RecadoRecord
 *
 * @author Paavo Soeiro
 */
class RecadoRecord extends ManipulaBanco {

    private $recados;

    public function cadastrar($recado) {
        $dados['remetente'] = $recado->getRemetente();
        $dados['destinatario'] = $recado->getDestinatario();
        $dados['datahora'] = $recado->getDataHora();
        $dados['mensagem'] = $recado->getMensagem();
        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['IDRECADO']); $i++) {
            $this->recados[$i] = new Recado($a['IDRECADO'][$i],
                            $a['REMETENTE'][$i],
                            $a['DESTINATARIO'][$i],
                            $a['DATA'][$i],
                            $a['MENSAGEM'][$i]);
        }
        return $this->recados;
    }

}

?>
