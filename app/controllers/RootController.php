<?php
class RootController extends Controller
{

        function _default()
        {
			include("index.html");
        }
        function _error()
        {
        echo $this->Command;
        }
		
}
?>