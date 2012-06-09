<?php

class URLInterpreter
      {

      var $Command;

      function URLInterpreter()
            {
            $requestURI = explode('/', $_SERVER['REQUEST_URI']);
            $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
            $commandArray = array_diff_assoc($requestURI,$scriptName);
            $commandArray = array_values($commandArray);
            $controllerName = $commandArray[0];
            if(isset($commandArray[1])){
				$controllerFunction = $commandArray[1];
			}else{
				$controllerFunction = '';
			}
            $parameters = array_slice($commandArray,2);
			
            if($controllerName == '')
                  {
                  $controllerName = 'root';
                  }

            $this->Command = new Command($controllerName,$controllerFunction,$parameters);
            }

      function getCommand()
            {
            return $this->Command;
            }
      }
?>