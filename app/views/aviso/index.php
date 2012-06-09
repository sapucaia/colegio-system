<?php

require '../../../conf/lock.php';

#include '../../controllers/AvisoController.class.php';
#include '../../controllers/AvisoController.class.php';

$avisos = $_SESSION['todosAvisos'];

print_r($avisos);

foreach($avisos as $aviso){
	echo $aviso->getData()." - ". $aviso->getAviso();
}
?>
