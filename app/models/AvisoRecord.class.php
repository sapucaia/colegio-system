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
            $this->avisos[$i] = new Aviso($a['ID'][$i], $a['AVISO'][$i], $a['DATA'][$i]);
        }
        return $this->avisos;
    }

    public function getAviso($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("id", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $aviso = new Aviso($a['ID'][1], $a['DATA'][1], $a['AVISO'][1]);
    }

    public function find_by_id($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("id", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $aviso = new Aviso($a['ID'][1], $a['AVISO'][1], $a['DATA'][1]);
    }

    public function remover($id) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter("id", "=", $id));
        return $this->deletar($criteria) ? true : false;
    }

}

?>
