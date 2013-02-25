<?php

//echo 'salvar';
require '../conf/lock.php';

$model = $_POST['model'];
//$form = $_POST['dados'];
parse_str($_POST['dados'], $form);
unset($form['model']);


$recordClass = ucfirst($model) . "Record";

$record = new $recordClass;

//print_r($form);
//print_r($model);

if ($record->salvar($form)) {
//    echo 'Salvou ';
    $last_id = $record->ultimoId();
    $object = $record->find_by_id($last_id);
//    json_encode( (array)$object );
//    echo json_encode($object);
    $array = (array) $object;
    $key = ucfirst($model) . "id" . ucfirst($model);
//    unset($array[$key]);
    $array = array_diff($array, array($last_id));
    $array["Edit"] = "Editar";
    $array["Remover"] = "<a class='link_remover' href='" . $model . "/remover/" . $last_id . "'>Remover</a>";
    echo json_encode($array);
//    json_encode(array("Apple", "Banana", "Pear"));
} else {
    echo 'tedio';
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
