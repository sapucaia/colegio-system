<?php

define('APP_PATH', '../');
require 'utils/autoload.php';

if (isset($_POST['sgbd'])) {
    require '../aplicacao/db/BD.php';
    $db = $_POST['sgbd'];
    if ($db !== false) {
        $tmp = file_get_contents("../aplicacao/db/{$db}.db");
        $db = unserialize($tmp);
        $conf = $db->toArray();
        $config_db = array(
            "development" => $conf
        );
    }
    $args[1] = $_POST['faction'];
} elseif (isset($_POST['migrate'])) {
    require '../aplicacao/db/BD.php';
    $origin = $_POST['origin'];
    $destine = $_POST['destine'];
    if ($origin !== false) {
        $tmp = file_get_contents("../aplicacao/db/{$origin}.db");
        $db = unserialize($tmp);
        $origin_db = $db->toArray();
    }
    if ($destine !== false) {
        $tmp = file_get_contents("../aplicacao/db/{$destine}.db");
        $db = unserialize($tmp);
        $destine_db = $db->toArray();
    }
    if ($origin_db !== false && $destine_db !== false) {
        $config_db = array(
            "data_migration" => array(
                'origin' => $origin_db,
                'destine' => $destine_db
            )
        );
    }

    $args[1] = $_POST['faction'];
} elseif (isset($argv)) {
    $args = $argv;
    $config_db = include 'config/db.inc.php';
} else {
    $config_db = include 'config/db.inc.php';
    $args = array(1 => "db:migrate");
//    $args = array(1 => "db:migrator");
//    $args = array(1 => "db:migrate:down");
 //   $args = array(1 => "db:generate", 2 => "create_table_usuarios");
}
//$migration_dir = "../migrations";
//$args = array(1 => "db:migrate", 2 => "distributed");
//$args = array(1 => "db:migrate:down", 2 => "distributed");
//$args = array(1 => "db:migrate:up");
//$args = array(1 => "db:migrator");
//$args = array(1 => "db:generate", 2 => "create_table_temp");
//$args = array(1 => "db:generate", 2 => "migrate_colegioc_to_colegio");
$arg = explode(":", $args[1]);
$arg = ucfirst($arg[1]);

$command = new $arg($args, $config_db);
$action = $command->action;

$act = new $action();
$command->setAction($act);
$command->execute();
//
//$db = $config_db["data_migration"];
//$adapterOrigin = AdapterFactory::getAdapter($db['origin']['adapter'], $db);
//$adapterDestine = AdapterFactory::getAdapter($db['destine']['adapter'], $db);
//
//$adapterOrigin->setBase('origin');
//$adapterDestine->setBase('destine');
//$tables = $adapterOrigin->getTables();
//
//foreach ($tables as $table) {
//    if (!array_key_exists($table->TABLE_NAME, $tables))
//        $inserts[$table->TABLE_NAME] = $table->TABLE_NAME;
////    $pre = $refs[$table->TABLE_NAME];
//    $refs = $adapterOrigin->getReferences($table->TABLE_NAME);
//
//    foreach ($refs as $reference) {
//        if (!array_key_exists($reference->TABLE_TARGET, $inserts))
//            $inserts = Utils::array_insert_before($table->TABLE_NAME, $inserts, $reference->TABLE_TARGET, $reference->TABLE_TARGET);
//    }
////    echo $table->TABLE_NAME . "<br>";
////    print_r($table);
////    echo "<br>";
//}
//print_r($inserts);
//
//foreach ($inserts as $insert) {
//    $database_data[] = $adapterOrigin->select($insert);
//}
//foreach ($database_data as $data) {
//    echo "LINHA " . $data . "<br>";
//}
////for ($i = 0; i <= count($inserts); $i++) {
////    echo "INSERT: " . $adapterDestine->insert($inserts[$i], $database_data[$i]) . "<br>";
////}
//$i = 0;
////$inserts = array_reverse($inserts);
//foreach ($inserts as $inserir) {
//    $adapterDestine->disableSequencies($inserir);
//    $adapterDestine->insert($inserir, $database_data[$i++]);
//    $adapterDestine->enableSequencies($inserir);
//}
//$adapterDestine->populateDatabase();
//print_r($database_data);
//print_r($tables);
//$refs = $adapterOrigin->getReferences();
//foreach ($refs as $ref) {
////    echo $ref->TABLE_NAME . "<br>";
////    echo $ref->TABLE_TARGET . "<br>";
////    echo $ref->COLUMN_NAME . "<br>";
////    echo $ref->COLUMN_TARGET . "<br>";
//    print_r($ref);
//    echo "<br>";
//}
//print_r($refs);
//
//function array_insert_before($key, array &$array, $new_key, $new_value) {
//    if (array_key_exists($key, $array)) {
//        $new = array();
//        foreach ($array as $k => $value) {
//            if ($k === $key) {
//                $new[$new_key] = $new_value;
//            }
//            $new[$k] = $value;
//        }
//        return $new;
//    }
//    return FALSE;
//}
//
//$tables = array(
//    array('name' => 'usuario'),
//    array('name' => 'pessoa'),
//    array('name' => 'endereco'),
//    array('name' => 'role'),
//    array('name' => 'usuario_role'),
//    array('name' => 'temp')
//);
//
//$refs = array(
//    'usuario' => array('pessoa', 'temp'),
//    'pessoa' => array('endereco'),
//    'usuario_role' => array('usuario', 'role')
//);
//
//foreach ($tables as $table) {
//    if (!array_key_exists($table['name'], $tables))
//        $insert[$table['name']] = $table['name'];
//    $pre = $refs[$table['name']];
//    foreach ($pre as $ref) {
//        if (!array_key_exists($ref, $insert))
//            $insert = array_insert_before($table['name'], $insert, $ref, $ref);
//    }
//}
////
//print_r($insert);
//print_r($tables);
//$src = array('a' => "A", 'b' => "B", 'c' => "C");
//$in = array('x' => "X", 'y' => "Y");
//
//var_dump(array_push_before($src, $in, 'b'));
//PutEnv("ORACLE_SID=BASE1");
//PutEnv("ORACLE_HOME=C:/app/Lorrane/product/11.2.0");
//PutEnv("TNS_ADMIN=C:/app/Lorrane/product/11.2.0/dbhome_1/NETWORK\ADMIN");
//$tnsName = "BASE1 =
//  (DESCRIPTION =
//    (ADDRESS = (PROTOCOL = TCP)(HOST = computador)(PORT = 1521))
//    (CONNECT_DATA =
//      (SERVER = DEDICATED)
//      (SERVICE_NAME = base1.localhost)
//    )
//  )";
//phpinfo();
//$conexao = oci_connect('paavo', 'paavo', "base1");
//if ($conexao) {
//    echo 'teste';
//} else {
//    echo 'merda';
//    $e = oci_error();
//    echo $e['message'];
//   
//}
?>
