<?php
require 'conf/lock.php';
$galeriaRecord = new GaleriaRecord();
$galerias = $galeriaRecord->listar();
$fotoRecord = new FotoRecord();

if (isset($galerias)) {
    foreach ($galerias as $galeria) {
        $capa = $fotoRecord->getFoto($galeria->getCapa());
        ?>

        <ul>
            <li>
                <p><?php echo $galeria->getNomeGaleria(); ?></p>
                <a href="igaleria.php?id=<?php echo $galeria->getIdGaleria(); ?>"><img src="<?php echo THUMBPATH . $capa->getThumbnail(); ?>"/></a>
            </li>
        </ul>
        <?php
    }
}?>