<div class="formulario">
    <form action="recado/salvar" method="POST">
            <label for="remetente">Remetente: </label><input type="text" name="remetente" maxlength="30"> 
            <label for="destinatario">Destinat&aacute;rio: </label><input type="text" name="destinatario" maxlength="30"> 
            <label for="mensagem">Mensagem: </label><textarea  name="mensagem" maxlength="400" rows="4" cols="10"></textarea><br/> 
            <input type="submit" value="Cadastrar">
            <input type="reset" value="Limpar">
    </form>
</div>