
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
        <th></th>
        <th></th>

        </thead>
        <tbody>
            <?php foreach ($todos as $noticia) { ?>
                <tr>
                    <td><?php echo $noticia->getIdNoticia(); ?></td>
                    <td><?php echo "<a href=noticia/editar/" . $noticia->getIdNoticia() . ">" . $noticia->getNoticia() . "</a>"; ?></td>
                    <td><?php echo $noticia->getDataNoticia(); ?></td>
                    <td><?php echo $noticia->getTitulo(); ?></td>
                    <td></td>
                    <td><a class="link_remover" href="noticia/remover/<?php echo "" . $noticia->getIdNoticia(); ?>" >Remover</a></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
<div class="command"><a href="app/views/noticia/novo.php">Novo</a></div>
</div>