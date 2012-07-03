
<?php
$todos = unserialize($todos);

function mudaStatus($recado) {
    $str;
    if ($recado->getStatus() == 1)
        $str = 'Esperando avalia&ccedil;&atilde;o';
    else
        $str = 'Recado liberado';
    return $str;
}
?>



<h1>Administra&ccedil;&atilde;o - Recados</h1>
<div id="botoes">
    <ul id="btAdministra">

        <li><a href="recado/novo">Novo recado</a></li>
        <li><a href="recado/mostrar">Mostrar recados</a></li>

    </ul>
</div>
<p><a href="admMenuPrincipal">Voltar</a></p>
<div id="corpo">
    <div>
        <table id="myTable" class="tablesorter">
            <thead>
            <th>Remetente</th>
            <th>Destinat&aacute;rio</th>
            <th>Data</th>
            <th>Mensagem</th>
            <th>Status</th>
            </thead>
            <tbody>
<?php foreach ($todos as $recado) { ?>
                    <tr>
                        <td><?php echo "<a href=recado/editar/" . $recado->getIdRecado() . ">" . $recado->getRemetente() . "</a>"; ?></td>
                        <td><?php echo $recado->getDestinatario(); ?></td>
                        <td><?php echo $recado->getDataHora(); ?></td>
                        <td><?php echo $recado->getMensagem(); ?></td>
                        <td><?php echo mudaStatus($recado)?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
