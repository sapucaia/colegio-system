<?php

require_once('../core/dispatcher/Command.php');
require_once('../core/dispatcher/UrlInterpreter.php');
require_once('../core/dispatcher/CommandDispatcher.php');
require_once('../core/dispatcher/Controller.php');

$urlInterpreter = new UrlInterpreter();
$command = $urlInterpreter->getCommand();
$commandDispatcher = new CommandDispatcher($command, true);
$commandDispatcher->Dispatch();
?>