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
                <th>Remetente</th>
                <th>Destinat&aacute;rio</th>
                <th>Data</th>
                <th>Mensagem</th>
                </thead>
                <tbody>
                    <?php foreach ($todos as $recado) { ?>
                        <tr>
                            <td><?php echo $recado->getIdRecado(); ?></td> 
                            <td><?php echo $recado->getRemetente(); ?></td>
                            <td><?php echo $recado->getDestinatario(); ?></td>
                            <td><?php echo $recado->getDataHora(); ?></td>
                            <td><?php echo $recado->getMensagem(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <p><a href="../recado">Voltar</a></p>
    </body>
</html>