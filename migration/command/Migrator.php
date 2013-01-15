<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Migrator
 *
 * @author Paavo Soeiro
 */
class Migrator implements ICommand {

    private $db;
    private $action;

    public function __construct($args, $config_db = null) {
        $tool = $args[1];
        $temp = explode(":", $tool);
        $temp[0] = ucfirst($temp[0]);
        $temp[1] = ucfirst($temp[1]);

        $action = implode("", array($temp[0], $temp[1]));

        $this->db = $config_db["data_migration"];

        $this->action = $action;

//        $this->action->setDB($this->db);
    }

    public function __get($propriedade) {
        return $this->$propriedade;
    }

    public function setAction(IAction $action) {
        $this->action = $action;
        $this->action->setDB($this->db);
    }

    public function execute() {
        try {
            $this->action->run();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}

?>
