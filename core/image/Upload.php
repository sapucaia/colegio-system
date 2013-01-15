<?php

/**
 * Description of Upload
 *
 * @author Paavo Soeiro
 */
class Upload {

    private $directory;
    private $directoryThumb;

    function __construct() {
        $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
        $this->directory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . IMAGEPATH;
        $this->directoryThumb = $this->directory . 'thumbs/';
    }

    public function salvar($fileName, $tmpName) {
        @is_uploaded_file($tmpName)
                or die('not an HTTP upload');

        @move_uploaded_file($tmpName, $this->directory . $fileName)
                or die('receiving directory insuffiecient permission');

        return $this->createThumbnail($fileName, $tmpName);
    }

    public function createThumbnail($fileName, $tmpName) {
        $thumb = imagecreatetruecolor(100, 100);
        echo $tmpName . '<br>';
        $tamanho = @getimagesize($this->directory . $fileName)
                or die('only image uploads are allowed');
        $ext = $this->getExtension($fileName);
        if ($ext == "jpg")
            $ext = "jpeg";

        $imagem_orig = call_user_func("imagecreatefrom" . $ext, $this->directory . $fileName);
        imagecopyresized($thumb, $imagem_orig, 0, 0, 0, 0, 100, 100, $tamanho[0], $tamanho[1]);
        $nome = substr($fileName, 0, -4);
        $path = $this->directoryThumb . $nome . '100x100.' . $ext;
        call_user_func('image' . $ext, $thumb, $path);
        return $nome . '100x100.' . $ext;
    }

    function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

}

?>
