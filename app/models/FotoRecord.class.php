<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FotoRecord
 *
 * @author Paavo Soeiro
 */
class FotoRecord extends ManipulaBanco {

    private $fotos = null;

    public function cadastrar(Foto $foto) {
        $dados['galeriaid'] = $foto->getIdGaleria();
        $dados['foto'] = $foto->getNome();
        $dados['url'] = $foto->getUrl();
        $dados['thumbnail'] = $foto->getThumbnail();
        $dados['descricao'] = $foto->getDescricao();

        return $this->salvar($dados);
    }

    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['ID']); $i++) {
            $this->fotos[$i] = new Foto($a['ID'][$i],
                            $a['GALERIAID'][$i],
                            $a['FOTO'][$i],
                            $a['URL'][$i],
                            $a['DATAFOTO'][$i],
                            $a['DESCRICAO'][$i],
                            $a['THUMBNAIL'][$i]);
        }
        return $this->fotos;
    }

    public function listarFotosPorGaleria($idGaleria) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("galeriaid", "=", $idGaleria));
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['ID']); $i++) {
            $this->fotos[$i] = new Foto($a['ID'][$i],
                            $a['GALERIAID'][$i],
                            $a['FOTO'][$i],
                            $a['URL'][$i],
                            $a['DATAFOTO'][$i],
                            $a['DESCRICAO'][$i],
                            $a['THUMBNAIL'][$i]);
        }
        return $this->fotos;
    }

    public function getFoto($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("id", "=", $id));
        $a = $this->selecionarColecao($criteria);

        $foto = new Foto($a['ID'][1],
                        $a['GALERIAID'][1],
                        $a['FOTO'][1],
                        $a['URL'][1],
                        $a['DATAFOTO'][1],
                        $a['DESCRICAO'][1],
                        $a['THUMBNAIL'][1]);

        return $foto;
    }

}

?>
