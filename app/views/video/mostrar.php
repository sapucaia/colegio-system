<?php
$todos = unserialize($todos);
?>


<html>
    <head>
        <link href="../recursos/css/formulario" type="text/css" rel="stylesheet"/>
        <link href="../recursos/css/tabela" type="text/css" rel="stylesheet"/>
        <script src="../recursos/javascript/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="../recursos/javascript/jquery.tablesorter.js" type="text/javascript"></script>
        <script src="../recursos/javascript/tabela.js" type="text/javascript"></script>


    </head>
    <body>
        <div id="corpo">
            <table id="myTable" class="tablesorter">
                <thead>
                <th>Identificador</th>
                <th>T&iacute;tulo</th>
                <th>URL</th>
                </thead>
                <tbody>
                    <?php foreach ($todos as $video) { ?>
                        <tr>
                            <td><?php echo $video->getIdVideo() ?></td>
                            <td><?php echo $video->getTitulo(); ?></td>
                            <td><?php echo $video->getUrl(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <p id="voltar"><a href="../video">Voltar</a></p>
</body>
</html>