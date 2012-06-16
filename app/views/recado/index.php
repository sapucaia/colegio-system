
<?php
$todos = unserialize($todos);
?>

<html>
    <head>
        <link href="recursos/css/formulario" type="text/css" rel="stylesheet"/>
    </head>
    <body>
    <h1>Recados - Avisos </h1>
    <div id="botoes">
        <ul id="btAdministra">
            
            <li><a href="aviso/mostrar">Mostrar avisos</a></li>
            
        </ul>
    </div>
    <p><a href="admMenuPrincipal">Voltar</a></p>
    <div id="corpo">
        <div>
            <table>
                <thead>
                <th>Aviso</th>
                <th>Data</th>
                </thead>
                <tbody>
                    <?php foreach ($todos as $recado) { ?>
                        <tr>
                            <td><?php echo "<a href=recado/editar/" . $aviso->getIdAviso() . ">" . $aviso->getAviso() . "</a>"; ?></td>
                            <td><?php echo $aviso->getData(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>