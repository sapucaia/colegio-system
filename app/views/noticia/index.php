
<?php
$noticiaRecord = new NoticiaRecord;
$todos = $noticiaRecord->listar();
?>


<div id="corpo">
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
<div class="command"><a href="app/views/noticia/novo.php">Novo</a></div>
</div>