<?php

require '../conf/lock.php';

$model = $_POST['model'];
$form = $_POST['dados'];

$recordClass = ucfirst($model)."Record";

$record = new $recordClass;

print_r($form);
print_r($model);

//if($record->salvar($form))
//    echo 'Salvou ';
//else
//    echo 'tedio';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
