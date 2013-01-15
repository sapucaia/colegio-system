<?php

//$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

require ROOT . 'core/image/Upload.php';

/**
 * Description of FotoController
 *
 * @author Paavo Soeiro
 */
class FotoController extends Controller {

    private $PATH;
    private $upload;

    function FotoController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/foto/";
        } else {
            $this->PATH = "../app/views/foto/";
        }
        $this->upload = new Upload();
    }

    function _default() {

//        $fotoRecord = new GaleriaRecord();
//        $todos = $fotoRecord->listar();
//        $todos = serialize($todos);

        include($this->PATH . 'index.php');
    }
    
    function _novo() {
        include($this->PATH . 'novo.php');
    }

    function _salvar() {
        $form = $_POST;
        $file = $_FILES;

        $fileName = $file['image']['name'];
        $tmpName = $file['image']['tmp_name'];
        $fileSize = $file['image']['size'];
        $fileType = $file['image']['type'];
        
        $thumb = $this->upload->salvar($fileName, $tmpName);
//        $thumb = $this->upload->createThumbnail($fileName, $tmpName);
        $foto = new Foto();
        $fotoRecord = new FotoRecord;
        $foto->setNome($fileName);
        $foto->setThumbnail($thumb);
        $foto->setDescricao("Texto");
        $foto->setIdGaleria(2);
        $fotoRecord->cadastrar($foto);
        echo $thumb;
    }

}

?>
