
<?php
$todos = unserialize($todos);
?>

<html>
    <head>
        <link href="recursos/css/formulario" type="text/css" rel="stylesheet"/>
        <link href="recursos/css/tabela" type="text/css" rel="stylesheet"/>
        <script src="recursos/javascript/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="recursos/javascript/jquery.tablesorter.js" type="text/javascript"></script>
        <script src="recursos/javascript/tabela.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>Administração - V&iacute;deos </h1>
        <div id="botoes">
            <ul id="btAdministra">
                <li><a href="video/novo">Adcionar v&iacute;deo</a></li>
                <li><a href="video/mostrar">Mostrar v&iacute;deo</a></li>
            </ul>
        </div>
        
        <div id="corpo">
            <div>
                <table id="myTable" class="tablesorter">
                    <thead>

                    
                    <th>T&iacute;tulo</th>
                    <th>URL</th>
                    
                    </thead>
                    <tbody>
                        <?php foreach ($todos as $video) { ?>
                            <tr>
                                <td><?php echo "<a href=video/editar/" . $video->getIdVideo() . ">" . $video->getTitulo() . "</a>"; ?></td>
                                <td><?php echo $video->getUrl(); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
        <p id="voltar"><a href="admMenuPrincipal">Voltar</a></p>
    </body>
</html>