<?

class Command {

    var $Name = '';
    var $Function = '';
    var $Parameters = array();
    var $Module;

    function Command($controllerName, $functionName, $parameters, $module = null) {
        $this->Parameters = $parameters;
        $this->Name = $controllerName;
        $this->Function = $functionName;
        $this->Module = $module;
    }

    function getControllerName() {
        return $this->Name;
    }

    function setControllerName($controllerName) {
        $this->Name = $controllerName;
    }

    function getFunction() {
        return $this->Function;
    }

    function setFunction($functionName) {
        $this->Function = $functionName;
    }

    function getParameters() {
        return $this->Parameters;
    }

    function setParameters($controllerParameters) {
        $this->Parameters = $controllerParameters;
    }
    
    public function getModule() {
        return $this->Module;
    }

    public function setModule($Module) {
        $this->Module = $Module;
    }



}
?>