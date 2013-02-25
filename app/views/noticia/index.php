
<?php
$noticiaRecord = new NoticiaRecord;
$todos = $noticiaRecord->listar();
?>


<div id="corpo">
    <table class="tablesorter tableNoticia">
        <thead>
            <!--<tr>-->
                <th>T&iacute;tulo</th>
                <th>Not&iacute;cia</th>
                <th>Data</th>
                <th></th>
            <!--</tr>-->
            <th></th>
            <!--<th></th>-->
        </thead>
        <tbody>
            <?php foreach ($todos as $noticia) { ?>
                <tr>
                    <td><?php echo $noticia->getTitulo(); ?></td>
                    <td><?php echo "<a href=noticia/editar/" . $noticia->getIdNoticia() . ">" . $noticia->getNoticia() . "</a>"; ?></td>
                    <td><?php echo $noticia->getDataNoticia(); ?></td>
                    <td></td>
                    <td><a class="link_remover" href="noticia/remover/<?php echo "" . $noticia->getIdNoticia(); ?>" >Remover</a></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="command"><a href="app/views/noticia/novo.php">Novo</a></div>
</div>