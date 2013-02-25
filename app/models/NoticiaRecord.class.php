<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NoticiaRecord extends ManipulaBanco {

    private $noticias;

    public function cadastrar($noticia) {
        $dados['titulo'] = $noticia->getTitulo();
        $dados['noticia'] = $noticia->getNoticia();
        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['ID']); $i++) {
            $this->noticias[$i] = new Noticia($a['ID'][$i], $a['TITULO'][$i], $a['NOTICIA'][$i], $a['DATANOTICIA'][$i]);
        }
        return $this->noticias;
    }

    public function getNoticia($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("id", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $noticia = new Noticia($a['ID'][1], $a['DATA'][1], $a['TITULO'][1], $a['NOTICIA'][1]);
    }

    public function find_by_id($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("id", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $noticia = new Noticia($a['ID'][1], $a['TITULO'][1], $a['NOTICIA'][1], $a['DATANOTICIA'][1]);
    }

    public function remover($id) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter("id", "=", $id));
        $this->deletar($criteria);
        return true;
    }

}

?>