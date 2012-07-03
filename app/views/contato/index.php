
<?php
$todos = unserialize($todos);
?>

<html>
    <head>
        <link href="recursos/css/formulario" type="text/css" rel="stylesheet"/>
    </head>
    <body>
    <h1>Administração - Contatos </h1>
    <div id="botoes">
        <ul id="btAdministra">
            <li><a href="contato/novo">Adcionar contatos</a></li>
            <li><a href="contato/mostrar">Mostrar contatos</a></li>
        </ul>
    </div>
    <p><a href="admMenuPrincipal">Voltar</a></p>
    <div id="corpo">
        <div>
            <table>
                <thead>
                <th>Contato</th>
                <th>Data</th>
                </thead>
                <tbody>
                    <?php foreach ($todos as $contato) { ?>
                        <tr>
                            <td><?php echo "<a href=contato/editar/" . $contato->getIdContato() . ">" . $contato->getRemetente() . "</a>"; ?></td>
                            <td><?php echo $contato->getEmail(); ?></td>
                            <td><?php echo $contato->getAssunto(); ?></td>
                            <td><?php echo $contato->getMensagem(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>