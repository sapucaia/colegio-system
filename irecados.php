<?php
    require 'conf/lock.php';
    $recadoRecord = new RecadoRecord();
    $recados = $recadoRecord->listar();
    foreach($recados as $recado){
?>
<div class="recado">
    <p>Data:&nbsp;<?php echo $recado->getDataHora();?></p>
    <p>Remetente:&nbsp;<?php echo $recado->getRemetente();?></p>
    <p>Destinatario:&nbsp;<?php echo $recado->getDestinatario();?></p>
    <p>Mensagem:&nbsp;<?php echo $recado->getMensagem();?></p>
</div>
<?php }?>