<?php $objeto = unserialize($objeto) ?>
<form action="../atualizar" method="POST">

    <textarea name="aviso"><?php echo '' . $objeto->getAviso(); ?></textarea>
    <input type="hidden" name="idaviso" value="<?php echo "" . $objeto->getIdAviso(); ?>">

    <input type="submit" value="Atualizar">

</form>




<a href="noticia/remover/<?php echo "" . $objeto->getIdAviso(); ?>" >Remover</a>







