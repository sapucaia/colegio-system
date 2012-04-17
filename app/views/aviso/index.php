<?php

require '../../../conf/lock.php';

$avisoRecord = new AvisoRecord();

$avisos = $avisoRecord->listar();

foreach ($avisos as $aviso) {
  echo $aviso->getData() . " - " . $aviso->getAviso() . "<br>";
}
?>
