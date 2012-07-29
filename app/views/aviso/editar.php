<?php $objeto = unserialize($objeto) ?>
        <form action="../atualizar" method="POST">

            <textarea name="aviso"><?php echo '' . $objeto->getAviso(); ?></textarea>
            <input type="hidden" name="idaviso" value="<?php echo "" . $objeto->getIdAviso(); ?>">

            <input type="submit" value="Atualizar">

        </form>
        
        
        <form action="../remover" method="POST">
            
            <input type="hidden" name="idaviso" value="<?php echo "".$objeto->getIdAviso(); ?>">
            <input type="submit" value="Remover aviso" >
        </form>
        
        <p id="voltar"><a href="../../aviso">Voltar</a></p>  
        
    

