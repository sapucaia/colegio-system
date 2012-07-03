<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NoticiaRecord extends ManipulaBanco{
    
    
    private $noticias;


    public function cadastrar($noticia) {
        $dados['titulo'] = $noticia->getTitulo();
        $dados['noticia'] = $noticia->getNoticia();
        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['IDNOTICIA']); $i++) {
            $this->noticias[$i] = new Noticia($a['IDNOTICIA'][$i],
                            $a['DATA'][$i],
                            $a['TITULO'][$i],
                            $a['NOTICIA'][$i]);
        }
        return $this->noticias;
    }
    
    public function getNoticia($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("idnoticia", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $noticia = new Noticia($a['IDNOTICIA'][1], $a['DATA'][1], $a['TITULO'][1], $a['NOTICIA'][1]);
    }

    public function removerNoticia($id) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter("idnoticia", "=", $id));
        $this->deletar($criteria);
        return true;
    }

    
    
    
    
    
}


?>
