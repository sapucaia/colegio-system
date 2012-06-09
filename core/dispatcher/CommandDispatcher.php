<?php

class CommandDispatcher {

    var $Command;

    function CommandDispatcher(&$command) {
        $this->Command = $command;
    }

    function isController($controllerName) {
        if (file_exists('app/controllers/' . ucfirst($controllerName) . 'Controller.php')) {
            return true;
        } else {
            return false;
        }
    }

    function Dispatch() {
        $controllerName = $this->Command->getControllerName();

        if ($this->isController($controllerName) == false) {
            $controllerName = 'error';
        }
        require('app/controllers/' . ucfirst($controllerName) . 'Controller.php');
        $controllerClass = ucfirst($controllerName) . "Controller";
        $controller = new $controllerClass($this->Command);
        $controller->execute();
    }

}
?>