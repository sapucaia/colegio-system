<?php
$todos = unserialize($todos);
?>


<div class="comandos"><a href="aviso/novo">Novo Aviso</a></div>
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
