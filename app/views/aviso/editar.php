<?php $objeto = unserialize($objeto) ?>
<html>
    <head></head>
    <body>
        
        <form action="../atualizar" method="POST">

            <textarea name="aviso"><?php echo '' . $objeto->getAviso(); ?></textarea>
            <input type="hidden" name="idaviso" value="<?php echo "" . $objeto->getIdAviso(); ?>">

            <input type="submit" value="Atualizar">

        </form>
        
        
        <form action="../remover" method="POST">
            
            <input type="hidden" name="idaviso" value="<?php echo "".$objeto->getIdAviso(); ?>">
            <input type="submit" value="Remover aviso">
        </form>
        
        <li><a href="../../aviso">Voltar</a></li>  
        
    </body>
</html>


