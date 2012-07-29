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
                <th>Aviso</th>
                <th>Data</th>
                </thead>
                <tbody>
                    <?php foreach ($todos as $aviso) { ?>
                        <tr>
                            <td><?php echo $aviso->getIdAviso(); ?></td>
                            <td><?php echo "<a href=../aviso/editar/" . $aviso->getIdAviso() . ">" . $aviso->getAviso() . "</a>"; ?></td>
                            <td><?php echo $aviso->getData(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <p id="voltar"><a href="../aviso">Voltar</a></p>
    </body>
</html>