<?php
require '../conf/lock.php';
if (empty($_SESSION['usuario'])) {
    header("Location: login");
    exit();
} else {
    $usuario = unserialize($_SESSION['usuario']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--<link href="recursos/css/tabela.css" type="text/css" rel="stylesheet"/>-->
        <link type="text/css" rel="stylesheet" href="recursos/css/jquery.dataTables.css"/>
        <link type="text/css" rel="stylesheet" href="recursos/css/jquery.dataTables_themeroller.css"/>
        <link type="text/css" rel="stylesheet" href="recursos/css/jquery.jgrowl.css"/>
        <!--<link type="text/css" rel="stylesheet" href="recursos/css/custom-theme/jquery-ui-1.9.1.custom.css"/>-->
        <link type="text/css" rel="stylesheet" href="recursos/css/smoothness/jquery-ui-1.10.1.custom.css"/>
        <link type="text/css" rel="stylesheet" href="recursos/css/estilo.css"/>
        <link type="text/css" rel="stylesheet" href="recursos/adm.css"/>
        <link type="text/css" rel="stylesheet" href="recursos/css/validate.css"/>

        <script type="text/javascript" src="recursos/javascript/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="recursos/javascript/jquery-ui-1.10.1.custom.js"></script>
        <script type="text/javascript" src="recursos/javascript/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="recursos/javascript/jquery.jgrowl.js"></script>
        <script type="text/javascript" src="recursos/javascript/jquery.blockUI.js"></script>
        <script type="text/javascript" src="recursos/javascript/jquery.validate.js"></script>
        <script type="text/javascript" src="recursos/javascript/validacao.js"></script>
        <script type="text/javascript" src="recursos/javascript/admin.js"></script>
        
        <!--<script type="text/javascript" src="recursos/javascript/carregamentoPaginaAdm.js"></script>-->
        <title>Colegio System - Admin</title>
    </head>
    <body>
        <div id="tabela_conteudo">
            <div id="topo">
                <h2>Colegio system - &Aacute;rea administrativa</h2>  
                <div id="box_uer">
                    <span>Ol&aacute;&nbsp;<?php echo $usuario->getNomeCompleto(); ?></span>
                    <div class="button_sair"><a href="login/logout">Sair</a></div>

                </div>
            </div>

            <div id="tabs">
                <ul>
                    <li><a href="#tabAvisos">Avisos</a></li>
                    <li><a href="#tabEmails">Emails Recebidos</a></li>
                    <li><a href="#tabFotos">Fotos</a></li>
                    <li><a href="#tabNoticias">Noticias</a></li>
                    <li><a href="#tabRecados">Recados</a></li>
                    <li><a href="#tabVideos">Videos</a></li>
                </ul>
                <div id="tabAvisos">
                    <?php
//                echo 'teste';
                    include"views/aviso/index.php";
//                print_r($todos);
                    ?>
                </div> 
                <div id="tabEmails">
                    <?php
                    include"views/email/index.php";
                    ?>
                </div> 
                <div id="tabFotos">
                    <?php
                    include"views/galeria/index.php";
                    ?>
                </div> 
                <div id="tabNoticias">
                    <?php
                    include"views/noticia/index.php";
                    ?>
                </div> 
                <div id="tabRecados">
                    <?php
                    include"views/recado/index.php";
                    ?>
                </div> 
                <div id="tabVideos">
                    <?php
                    include"views/video/index.php";
                    ?>
                </div> 
            </div>
            
        </div>
        <div id="rodape">
                <span>Sapucaia sistemas &copy; 2012 - 2013</span>
            </div>
    </body>
</html>