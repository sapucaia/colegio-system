<?php

/**
 * Description of AvisoRecord
 *
 * @author Paavo Soeiro
 */
class AvisoRecord extends ManipulaBanco {

    private $avisos;

    public function cadastrar($aviso) {
        $dados['data'] = $aviso->getData();
        $dados['aviso'] = $aviso->getAviso();
        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['IDAVISO']); $i++) {
            $this->avisos[$i] = new Aviso($a['IDAVISO'][$i],
                            $a['DATA'][$i],
                            $a['AVISO'][$i]);
        }
        return $this->avisos;
    }

}

?>
