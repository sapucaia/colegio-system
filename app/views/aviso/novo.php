<?php
require_once '../../../conf/lock.php';
$controller = new AvisoController()
?>


<form action="../../controllers/AvisoController.php" method="post">
    <fieldset>
        <label for="aviso">Aviso: <br></label><textarea name="aviso" cols="30" rows="10" maxlength="500"></textarea>
        <input type="submit" value="Cadastrar">
        <input type="reset" value="Limpar">
    </fieldset>
</form>