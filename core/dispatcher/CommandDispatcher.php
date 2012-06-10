<?php

class CommandDispatcher {

    var $Command;
    var $admin;

    function CommandDispatcher(&$command, $admin = false) {
        $this->Command = $command;
        $this->admin = $admin;
    }

    function isController($controllerName) {
        if (!$this->admin) {
            if (file_exists('app/controllers/' . ucfirst($controllerName) . 'Controller.php')) {
                return true;
            } else {
                return false;
            }
        } else {
            if (file_exists('../app/controllers/' . ucfirst($controllerName) . 'Controller.php')) {
                return true;
            } else {
                return false;
            }
        }
    }

    function Dispatch() {
        $controllerName = $this->Command->getControllerName();


        if ($this->isController($controllerName) == false) {
            $controllerName = 'error';
        }
        if (!$this->admin) {
            require('conf/lock.php');
        } else {
            require('../conf/lock.php');
        }
        $controllerClass = ucfirst($controllerName) . "Controller";
        $controller = new $controllerClass($this->Command);
        $controller->execute();
    }

}
?>