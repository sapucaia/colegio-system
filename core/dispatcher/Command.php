<?
class Command
      {
      var $Name = '';
      var $Function = '';
      var $Parameters = array();

      function Command($controllerName,$functionName,$parameters)
            {
            $this->Parameters = $parameters;
            $this->Name = $controllerName;
            $this->Function =$functionName;
            }

      function getControllerName()
            {
            return $this->Name;
            }

      function setControllerName($controllerName)
            {
            $this->Name = $controllerName;
            }

      function getFunction()
            {
            return $this->Function;
            }

      function setFunction($functionName)
            {
            $this->Function = $functionName;
            }

      function getParameters()
            {
            return $this->Parameters;
            }

      function setParameters($controllerParameters)
            {
            $this->Parameters = $controllerParameters;
            }
      }
?>