<?php $objeto = unserialize($objeto) ?>
<html>
    <head></head>
    <body>
        
        <form action="../atualizar" method="POST">

            <label for="titulo"> Titulo: </label> 
            <input name="titulo" type="text" value="<?php echo "".$objeto->getTitulo(); ?>" >
            <label for="url">URL:</label>
            <input name="url" value="<?php echo "".$objeto->getUrl(); ?>">
            
            <input type="hidden" name="idvideo" value="<?php echo "" . $objeto->getIdVideo(); ?>">

            <input type="submit" value="Atualizar">

        </form>
        
        
        <form action="../remover" method="POST">
            
            <input type="hidden" name="idvideo" value="<?php echo "".$objeto->getIdVideo(); ?>">
            <input type="submit" value="Remover video" >
        </form>
        
        <li><a href="../../video">Voltar</a></li>  
        
    </body>
</html>


