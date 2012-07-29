<?php $objeto = unserialize($objeto) ?>
<html>
    <head></head>
    <body>
        
        <form action="../atualizar" method="POST">

            <label for="titulo">Titulo:</label><input name="titulo" type="text" value="<?php echo $objeto->getTitulo(); ?>">
            <label for="noticia">Noticia:</label><textarea name="noticia"><?php echo '' . $objeto->getNoticia(); ?></textarea>
            <input type="hidden" name="idnoticia" value="<?php echo "" . $objeto->getIdNoticia(); ?>">

            <input type="submit" value="Atualizar">

        </form>
        
        
        <form action="../remover" method="POST">
            
            <input type="hidden" name="idnoticia" value="<?php echo "".$objeto->getIdNoticia(); ?>">
            <input type="submit" value="Remover noticia" >
        </form>
        
        <p id="voltar"><a href="../../noticia">Voltar</a></p>  
        
    </body>
</html>


