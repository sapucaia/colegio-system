<?php

//require_once '../action/DbGenerate.php';

/**
 * Description of Generator
 *
 * @author Paavo Soeiro
 */
class Generate  implements ICommand{

    private $action;
    private $migration;

    /*
     * $args[1] db:generate
     * $args[2] nome_migracao
     */

    public function __construct($args, $config_db = null) {
        $tool = explode(":", $args[1]);
        $temp[0] = ucfirst($tool[0]);
        $temp[1] = ucfirst($tool[1]);

        $this->migration = $args[2];

        $action = implode("", $temp);
        $this->action = $action;
    }
    
    public function __get($propriedade){
        return $this->$propriedade;
    }

    public function execute() {
        $this->action->run($this->migration);
    }
    
    public function setAction(IAction $action){
        $this->action = $action;
    }

}

?>
