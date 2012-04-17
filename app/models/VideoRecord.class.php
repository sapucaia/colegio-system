<?php

/**
 * Description of VideoRecord
 *
 * @author Paavo Soeiro
 */
class VideoRecord extends ManipulaBanco {

  public function cadastrar($video) {
    $dados['titulo'] = $video->getTitulo();
    $dados['url'] = $video->getUrl();
    return $this->salvar($dados);
  }

}

?>
