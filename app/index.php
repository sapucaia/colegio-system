<?php
require '../conf/lock.php';
if (!isset($_SESSION['usuario']))
    header("Location: login");
$usuario = unserialize($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href=""/>
        <script type="text/javascript" src="recursos/javascript/jquery-1.4.3.min.js"></script>
        <script type="text/javascript" src="recursos/javascript/carregamentoPaginaAdm.js"></script>
        <title></title>
    </head>
    <body>
        Ol&aacute;&nbsp;<?php echo $usuario->getNomeCompleto(); ?>
        <a href="login/logout">Sair</a>
        <h1>M&oacute;dulo de administra&ccedil;&atilde;o</h1>

        <div id="menuPrincipal">
            <ul>
                <li><a href="app/views/aviso/index.php">Avisos</a></li>
                <li><a href="">Recados</a></li>
                <li><a href="adm/contatoAdm.php">Contato</a></li>
                <li><a href="adm/videoAdm.php">V&iacute;deos</a></li>
            </ul>

        </div>
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
    </body>
</html>