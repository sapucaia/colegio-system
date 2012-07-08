<?php

/**
 * Description of NoticiaRecord
 *
 * @author Paavo Soeiro
 */
class NoticiaRecord {

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

}

?>
