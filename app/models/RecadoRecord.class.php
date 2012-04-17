<?php

/**
 * Description of RecadoRecord
 *
 * @author Paavo Soeiro
 */
class RecadoRecord extends ManipulaBanco {

  public function cadastrar($recado) {
    $dados['remetente'] = $recado->getRemetente();
    $dados['destinatario'] = $recado->getDestinatario();
    $dados['datahora'] = $recado->getDataHora();
    $dados['mensagem'] = $recado->getMensagem();
    return $this->salvar($dados);
  }

}

?>
