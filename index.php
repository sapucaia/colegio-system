<!DOCTYPE html>
<html>
    <head>
        <title>Col&eacute;gio - System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!--        <link href="recursos/css/reset.css" type="text/css" rel="stylesheet">-->

        <link href="recursos/css/index.css" type="text/css" rel="stylesheet">
        <link href="recursos/css/barraLinkSuperior.css" type="text/css" rel="stylesheet">
        <link href="recursos/css/barraLinkInferior.css" type="text/css" rel="stylesheet">
        <link href="recursos/css/formulario.css" type="text/css" rel="stylesheet"/>
        <link href="recursos/css/tabela.css" type="text/css" rel="stylesheet"/>
        <link href="recursos/css/camera.css" type="text/css" rel="stylesheet"/>
        <link href="recursos/jquery-ui-1.9.1.custom/css/custom-theme/jquery-ui-1.9.1.custom.css" type="text/css" rel="stylesheet"/>

        <script src="recursos/jquery-ui-1.9.1.custom/js/jquery-1.8.2.js" type="text/javascript"></script>
        <script src="recursos/javascript/jquery.mobile.customized.min.js" type="text/javascript"></script>
        <script src="recursos/javascript/jquery.easing.1.3.js" type="text/javascript"></script>
        <script src="recursos/javascript/jquery.tablesorter.js" type="text/javascript"></script>
        <script src="recursos/javascript/tabela.js" type="text/javascript"></script>
        <!--<script src="recursos/javascript/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>-->
        <script src="recursos/javascript/carregamentoPagina.js" type="text/javascript"></script>
        <!--<script src="recursos/javascript/efeitoBarra.js" type="text/javascript"></script>-->
        <script src="recursos/javascript/subMenu.js" type="text/javascript"></script>
        <script src="recursos/javascript/camera.js" type="text/javascript"></script>
        <script src="recursos/javascript/slide.js" type="text/javascript"></script>
        <script src="recursos/jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.js" type="text/javascript"></script>
        <script src="recursos/javascript/ui.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        define('APP_PATH', './');
        require 'core/autoload.php';

//        require_once('core/dispatcher/Command.php');
//        require_once('core/dispatcher/UrlInterpreter.php');
//        require_once('core/dispatcher/CommandDispatcher.php');
//        require_once('core/dispatcher/Controller.php');
        $urlInterpreter = new UrlInterpreter();
        $command = $urlInterpreter->getCommand();
        $commandDispatcher = new CommandDispatcher($command);
        $commandDispatcher->Dispatch();
        ?>
    </body>
</html>