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
        <div>
            <table id="myTable" class="tablesorter">
                <thead>
                <th>Identificador</th>
                <th>Data</th>
                <th>Titulo</th>
                <th>Noticia</th>
                </thead>
                <tbody>
                    <?php foreach ($todos as $noticia) { ?>
                        <tr>
                            <td><?php echo $noticia->getIdNoticia() ?></td> 
                            <td><?php echo $noticia->getDataNoticia() ?></td>
                            <td><?php echo $noticia->getTitulo(); ?></td>
                            <td><?php echo $noticia->getNoticia(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <li><a href="../noticia">Voltar</a></li>
</body>
</html>