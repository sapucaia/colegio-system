
<?php
$avisoRecord = new AvisoRecord();
$todos = $avisoRecord->listar();
?>

<!--    <h1>Administração - Avisos </h1>
    <div id="botoes">
        <ul id="btAdministra">
            <li><a href="aviso/novo">Adcionar aviso</a></li>
            <li><a href="aviso/mostrar">Mostrar avisos</a></li>
        </ul>
    </div>
    <p><a href="admMenuPrincipal">Voltar</a></p>-->
<div id="corpo">
    <table id="myTable" class="tablesorter">
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
    <div class="command"><a href="app/views/aviso/novo.php">Novo</a></div>
</div>