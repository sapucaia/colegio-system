<?php

/**
 * Description of VideoRecord
 *
 * @author Wallace Veidiano
 */
class VideoRecord extends ManipulaBanco {

    
    private $videos;


    public function cadastrar($video) {
    $dados['titulo'] = $video->getTitulo();
    $dados['url'] = $video->getUrl();
    return $this->salvar($dados);
  }
  
    public function listar() {
        $criteria = new TCriteria();
        $a = $this->selecionarColecao($criteria);
        for ($i = 1; $i <= count($a['IDVIDEO']); $i++) {
            $this->videos[$i] = new Video($a['IDVIDEO'][$i],
                            $a['TITULO'][$i],
                            $a['URL'][$i]);
        }
        return $this->videos;
    }

    public function getVideo($id) {
        $criteria = new TCriteria();
        $criteria->add(new TFilter("idvideo", "=", $id));
        $a = $this->selecionarColecao($criteria);
        return $video = new Video($a['IDVIDEO'][1], $a['TITULO'][1], $a['URL'][1]);
    }

    public function removerVideo($id) {
        $criteria = new TCriteria;
        $criteria->add(new TFilter("idvideo", "=", $id));
        $this->deletar($criteria);
        return true;
    }


}

?>
