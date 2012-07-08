<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Col&eacute;gio - System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="recursos/css/index.css" type="text/css" rel="stylesheet">
        <link href="recursos/css/barraLinkSuperior.css" type="text/css" rel="stylesheet">
        <link href="recursos/css/barraLinkInferior.css" type="text/css" rel="stylesheet">
        <script src="recursos/javascript/jquery-1.4.3.min.js" type="text/javascript"></script> 
        <script src="recursos/javascript/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>
        <script src="recursos/javascript/carregamentoPagina.js" type="text/javascript"></script>
        <script src="recursos/javascript/efeitoBarra.js" type="text/javascript"></script>
        <script src="recursos/javascript/subMenu.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        require_once('core/dispatcher/Command.php');
        require_once('core/dispatcher/UrlInterpreter.php');
        require_once('core/dispatcher/CommandDispatcher.php');
        require_once('core/dispatcher/Controller.php');
        $urlInterpreter = new UrlInterpreter();
        $command = $urlInterpreter->getCommand();
        $commandDispatcher = new CommandDispatcher($command);
        $commandDispatcher->Dispatch();
        ?>
    </body>
</html>