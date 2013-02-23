<div class="formulario">
    <form action="email/salvar" method="POST">
        <label for="remetente">Remetente :</label> <input type="text" name="remetente" maxlength="20">
        <label for="email">Email :</label> <input type="text" name="email" maxlength="30">
        <label for="assunto">Assunto :</label> <input type="text" name="assunto" maxlength="30">
        <label for="mensagem">Mensagem :</label> <textarea rows="10" cols="20" name="mensagem" maxlength="300" ></textarea><br/>
        <input type="submit" value="Enviar">
    </form>
</div>