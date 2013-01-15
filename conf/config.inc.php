<?php

/*
 * *********************************************
 * **********BANCO DE DADOS*********************
 * *********************************************
 */
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

//LOCAL    
define('DBNAME', 'colegio');
define('DBPASS', 'colegiosystem');
define('DBHOST', 'localhost');
define('DBUSER', 'colegio');
define('DBSGBD', 'postgres');

define('ROOT', $_SERVER['DOCUMENT_ROOT'] . $directory_self);
define('IMAGEPATH', 'recursos/galeria/');
define('THUMBPATH', IMAGEPATH . 'thumbs/');
?>
