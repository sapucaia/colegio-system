<?php
$todos = unserialize($todos);
?>



<div>
    <table>
        <thead>
        <th>Identificador</th>
        <th>Aviso</th>
        <th>Data</th>
        </thead>
        <tbody>
            <?php foreach ($todos as $aviso) { ?>
                <tr>
                    <td><?php echo $aviso->getIdAviso(); ?></td>
                    <td><?php echo "<a href=../aviso/editar/" . $aviso->getIdAviso() . ">" . $aviso->getAviso() . "</a>"; ?></td>
                    <td><?php echo $aviso->getData(); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<p><a href="../aviso">Voltar</a></p>
