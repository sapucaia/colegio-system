
<?php
$todos = unserialize($todos);
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href=""/>
        <script type="text/javascript" src="recursos/javascript/jquery-1.4.3.min.js"></script>
        <script type="text/javascript" src="recursos/javascript/carregamentoPaginaAdm.js"></script>
        <title></title>
    </head>
    <body>
        <h1>Administração - Avisos </h1>
        <div id="botoes">
            <ul id="btAdministra">
                <li><a href="aviso/novo.php">Adcionar aviso</a></li>
                <li><a href="#">Remover aviso</a></li>
                <li><a href="aviso/editar.php">Editar aviso</a></li>
                <li><a href="aviso/mostrar.php">Mostrar avisos</a></li>
            </ul>
        </div>
        <p><a href="adMmenuPrincipal.html">Voltar</a></p>
        <div id="corpo">
            <div>
                <table>
                    <thead>
                    <th>Aviso</th>
                    <th>Data</th>
                    </thead>
                    <tbody>
                        <?php foreach ($todos as $aviso) { ?>
                            <tr>
                                <td><?php echo "<a href=aviso/editar/" . $aviso->getIdAviso() . ">" . $aviso->getAviso() . "</a>"; ?></td>
                                <td><?php echo $aviso->getData(); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

    </body>
</html>
