<?php $objeto = unserialize($objeto) ?>
        
        <form action="noticia/atualizar" method="POST">

            <label for="titulo">Titulo:</label><input name="titulo" type="text" value="<?php echo $objeto->getTitulo(); ?>">
            <label for="noticia">Noticia:</label><textarea name="noticia"><?php echo '' . $objeto->getNoticia(); ?></textarea>
            <input type="hidden" name="idnoticia" value="<?php echo "" . $objeto->getIdNoticia(); ?>">

            <input type="submit" value="Atualizar">

        </form>
        
        
        <a href="../remover/<?php echo "" . $objeto->getIdNoticia(); ?>" >Remover</a>
        

        


