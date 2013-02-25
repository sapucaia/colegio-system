<?php
//                echo 'teste';
$emailRecord = new EmailRecord();
$todos = $emailRecord->listar();
//                print_r($todos);
?>
<!--<div style="clear:both;"></div>-->
<div id="corpo">
    <table class="tablesorter tableEmail">
        <thead>
        <th>Remetente</th>
        <th>Email</th>
        <th>Assunto</th>
        <th>Mensagem</th>
        <th></th>
        <th></th>
        </thead>
        <tbody>
            <?php foreach ($todos as $email) { ?>
                <tr>
                    <td><?php echo "<a href=email/editar/" . $email->getIdEmail() . ">" . $email->getRemetente() . "</a>"; ?></td>
                    <td><?php echo $email->getEmail(); ?></td>
                    <td><?php echo $email->getAssunto(); ?></td>
                    <td><?php echo $email->getMensagem(); ?></td>
                    <td></td>
                    <td><a class="link_remover" href="email/remover/<?php echo $email->getIdEmail(); ?>">Remover</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="command"><a href="app/views/email/novo.php">Novo</a></div>
</div>