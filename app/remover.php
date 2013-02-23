<?php

require '../conf/lock.php';

$model = $_GET['model'];
$id = $_GET['id'];

$recordClass = ucfirst($model)."Record";

$record = new $recordClass;
if($record->remover($id))
    echo 'Removeu ';
else
    echo 'tedio';


//echo $model . '<br>';
//echo $id . '<br>';
?>
