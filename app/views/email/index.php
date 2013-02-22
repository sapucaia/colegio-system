
<?php
$todos = unserialize($todos);
?>

<h1>Administração - Correio Eletr&ocirc;nico </h1>
<div id="botoes">
    <ul id="btAdministra">
        <li><a href="email/mostrar">Mostrar emails</a></li>
    </ul>
</div>
<p><a href="admMenuPrincipal">Voltar</a></p>
<div id="corpo">
    <div>
        <table id="tabela">
            <thead>
            <th>Remetente</th>
            <th>Email</th>
            <th>Assunto</th>
            <th>Mensagem</th>
            </thead>
            <tbody>
                <?php foreach ($todos as $email) { ?>
                    <tr>
                        <td><?php echo "<a href=email/editar/" . $email->getIdEmail() . ">" . $email->getRemetente() . "</a>"; ?></td>
                        <td><?php echo $email->getEmail(); ?></td>
                        <td><?php echo $email->getAssunto(); ?></td>
                        <td><?php echo $email->getMensagem(); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>

