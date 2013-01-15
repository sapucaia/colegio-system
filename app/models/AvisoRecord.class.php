<?php

/**
 * Description of AvisoRecord
 *
 * @author Wallace Veridiano
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
        for ($i = 1; $i <= count($a['ID']); $i++) {
            $this->avisos[$i] = new Aviso($a['ID'][$i],
                            $a['DATA'][$i],
                            $a['AVISO'][$i]);
        }
        return $this->avisos;
    }

    public function getAviso($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("idaviso", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $aviso = new Aviso($a['IDAVISO'][1], $a['DATA'][1], $a['AVISO'][1]);
    }

    public function removerAviso($id) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter("idaviso", "=", $id));
        $this->deletar($criteria);
        return true;
    }

}

?>
