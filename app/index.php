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


        <!--<link rel="stylesheet" href="recursos/css/bootstrap.min.css">-->
        <!-- Generic page styles -->
        <!--<link rel="stylesheet" href="recursos/css/style.css">-->
        <!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->
        <!--<link rel="stylesheet" href="recursos/css/bootstrap-responsive.min.css">-->
        <!-- Bootstrap CSS fixes for IE6 -->
        <!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
        <!-- Bootstrap Image Gallery styles -->
        <!--<link rel="stylesheet" href="recursos/css/bootstrap-image-gallery.min.css">-->
        <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
        <!--<link rel="stylesheet" href="recursos/css/jquery.fileupload-ui.css">-->

        <!--<script src="recursos/javascript/tmpl.min.js"></script>-->
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <!--<script src="recursos/javascript/load-image.min.js"></script>-->
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <!--<script src="recursos/javascript/canvas-to-blob.min.js"></script>-->
        <!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
        <!--<script src="recursos/javascript/bootstrap.min.js"></script>-->
        <!--<script src="recursos/javascript/bootstrap-image-gallery.min.js"></script>-->
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <!--<script src="recursos/javascript/jquery.iframe-transport.js"></script>-->
        <!-- The basic File Upload plugin -->
        <!--<script src="recursos/javascript/jquery.fileupload.js"></script>-->
        <!-- The File Upload file processing plugin -->
        <!--<script src="recursos/javascript/jquery.fileupload-fp.js"></script>-->
        <!-- The File Upload user interface plugin -->
        <!--<script src="recursos/javascript/jquery.fileupload-ui.js"></script>-->
        <!-- The main application script -->
        <!--<script src="../recursos/javascript/main.js"></script>-->

        <link rel="stylesheet" href="recursos/css/jquery.image-gallery.min.css">
        <!-- CSS to style the file input field as button and adjust the jQuery UI progress bars -->
        <link rel="stylesheet" href="recursos/css/jquery.fileupload-ui.css">
        <!-- CSS adjustments for browsers with JavaScript disabled -->
        <noscript><link rel="stylesheet" href="recursos/css/jquery.fileupload-ui-noscript.css"></noscript>
        <!-- Generic page styles -->
        <!--<link rel="stylesheet" href="recursos/css/style.css">-->

        <script src="recursos/javascript/tmpl.min.js"></script>
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <script src="recursos/javascript/load-image.min.js"></script>
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <script src="recursos/javascript/canvas-to-blob.min.js"></script>
        <!-- jQuery Image Gallery -->
        <script src="recursos/javascript/jquery.image-gallery.min.js"></script>
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <script src="recursos/javascript/jquery.iframe-transport.js"></script>
        <!-- The basic File Upload plugin -->
        <script src="recursos/javascript/jquery.fileupload.js"></script>
        <!-- The File Upload file processing plugin -->
        <script src="recursos/javascript/jquery.fileupload-fp.js"></script>
        <!-- The File Upload user interface plugin -->
        <script src="recursos/javascript/jquery.fileupload-ui.js"></script>
        <!-- The File Upload jQuery UI plugin -->
        <script src="recursos/javascript/jquery.fileupload-jui.js"></script>

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

