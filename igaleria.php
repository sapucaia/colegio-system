<?php
$idGaleria = $_GET['id'];
require 'conf/lock.php';
$fotoRecord = new FotoRecord();
$fotos = $fotoRecord->listarFotosPorGaleria($idGaleria);
?>
<link href="recursos/css/jquery.lightbox-0.5.css" type="text/css" rel="stylesheet"/>
<script src="recursos/javascript/jquery-1.4.3.min.js" type="text/javascript"></script> 
<script src="recursos/javascript/jquery.lightbox-0.5.js" type="text/javascript"></script>
<script src="recursos/javascript/galeria.js" type="text/javascript"></script>
<div id="gallery">
    <ul>
        <?php foreach ($fotos as $foto) {
            ?>
            <li>
                <a href="<?php echo IMAGEPATH . $foto->getNome(); ?>">
                    <img src="<?php echo THUMBPATH . $foto->getThumbnail(); ?>"/>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>