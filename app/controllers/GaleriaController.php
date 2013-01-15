<?php

/**
 * Description of GaleriaController
 *
 * @author Paavo Soeiro
 */
class GaleriaController extends Controller{
    private $PATH;
    
    function GaleriaController(&$command) {
        parent::__construct($command);
        if (!$this->Command->getModule() == "admin") {
            $this->PATH = "app/views/galeria/";
        } else {
            $this->PATH = "../app/views/galeria/";
        }
    }

    function _default() {

//        $galeriaRecord = new GaleriaRecord();
//        $todos = $galeriaRecord->listar();
//        $todos = serialize($todos);

        include($this->PATH . 'index.php');
    }
    
}

?>
