
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
        <h1>Administração - Noticias </h1>
        <div id="botoes">
            <ul id="btAdministra">
                <li><a href="noticia/novo">Adcionar noticia</a></li>
                <li><a href="noticia/mostrar">Mostrar noticia</a></li>
            </ul>
        </div>
        <p><a href="admMenuPrincipal">Voltar</a></p>
        <div id="corpo">
            <div>
                <table id="myTable" class="tablesorter">
                    <thead>
                    <th>Identificador</th>
                    <th>Not&iacute;cia</th>
                    <th>Data</th>
                    <th>T&iacute;tulo</th>
                   
                    </thead>
                    <tbody>
                        <?php foreach ($todos as $noticia) { ?>
                            <tr>
                                <td><?php echo $noticia->getIdNoticia(); ?></td>
                                <td><?php echo "<a href=noticia/editar/" . $noticia->getIdNoticia() . ">" . $noticia->getNoticia() . "</a>"; ?></td>
                                <td><?php echo $noticia->getDataNoticia(); ?></td>
                                <td><?php echo $noticia->getTitulo(); ?></td>
                               
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </body>
</html>