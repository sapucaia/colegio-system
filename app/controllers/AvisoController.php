<?php
class AvisoController extends Controller
{

        function _default()
        {
			echo $this->Command;
        }
        function _error()
        {
        echo $this->Command;
        }
        function _novo()
        {
        print_r($this->Command);
        }
		
		function _mostrar()
        {
        print_r($this->Command);
        }
}
?>