<?php $objeto = unserialize($objeto); ?>



<input type="text" name="remetente"  readonly="true" value="<?php echo "" . $objeto->getRemetente(); ?>" > <br>
<input type="text" name="destinatario"  readonly="true" value="<?php echo "" . $objeto->getDestinatario(); ?>" > <br>
<input type="text" name="data"  readonly="true" value="<?php echo "" . $objeto->getDataHora(); ?>" > <br>
<input type="text" name="status"  readonly="true" value="<?php echo "" . $objeto->getStatus(); ?>" > <br>
<textarea name="mensagem" readonly="true" cols="20" rows="20" maxlength="500"> <?php echo "" . $objeto->getMensagem(); ?> </textarea>


<form action="../liberar" method="POST">
    <input type="hidden" name="idrecado" value="<?php echo "" . $objeto->getIdRecado(); ?>">
    <input type="hidden" name="status" value="2">
    <input type="submit" value="Liberar recado">
</form>

<form action="../remover" method="POST">
    <input type="hidden" name="idrecado" value="<?php echo "" . $objeto->getIdRecado(); ?>">
    <input type="submit" value="Remover recado"> 
</form>
<p id="voltar"><a href="../../recado">Voltar</a></p>

