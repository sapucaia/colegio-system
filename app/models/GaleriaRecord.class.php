<?php

/**
 * Description of GaleriaRecord
 *
 * @author Paavo Soeiro
 */
class GaleriaRecord extends ManipulaBanco{
    
    private $galerias;
    
    public function cadastrar(Galeria $galeria){
        $dados['nomegaleria'] = $galeria->getNomeGaleria();
        $dados['datagaleria'] = $galeria->getDataGaleria();
        return $this->salvar($dados);
    }
    
    public function listar(){
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['IDGALERIA']); $i++) {
            $this->galerias[$i] = new Galeria($a['IDGALERIA'][$i],
                            $a['NOMEGALERIA'][$i],
                            $a['DATAGALERIA'][$i],
                            $a['CAPA'][$i]);
        }
        return $this->galerias;
    }
}

?>
