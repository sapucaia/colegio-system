<?php

require 'Autoloader.class.php';
if (file_exists(APP_PATH . 'core/adodb5/adodb.inc.php')) {
    include_once APP_PATH . 'core/adodb5/adodb.inc.php';
}
Autoloader::setCacheFilePath('class_path_cache.txt');
Autoloader::excludeFolderNamesMatchingRegex('/^CVS|\..*$/');
Autoloader::setClassFileSuffix('.php');
Autoloader::setClassPaths(array(
    APP_PATH . 'core/adodb5/',
    APP_PATH . 'core/app.ado/',
    APP_PATH . 'core/image/',
    APP_PATH . 'core/dispatcher/',
    APP_PATH . 'migration/action/',
    APP_PATH . 'migration/adapters/',
    APP_PATH . 'migration/base/',
    APP_PATH . 'migration/command/',
    APP_PATH . 'migration/config/',
    APP_PATH . 'migration/migrations/',
    APP_PATH . 'migration/table_definition/',
    APP_PATH . 'migration/utils/'
));
spl_autoload_register(array('Autoloader', 'loadClass'));
?>
