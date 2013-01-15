<?php

//require_once 'PostgresMigrationAdapter.php';
//require_once 'SqlServerAdapter.php';
//require_once 'OracleMigrationAdapter.php';
//require_once '../../conf/lock.php';

/**
 * Description of AdapterFactory
 *
 * @author Lorrane
 */
class AdapterFactory {

//    public static $adapter = 

    public static function getAdapter($adapter, $config) {
        if ($adapter == "postgres") {
            return new PostgresMigrationAdapter($config);
        } else if ($adapter == "mssqlnative") {
            return new SqlServerAdapter($config);
        } else if ($adapter == "oci8") {
            return new OracleMigrationAdapter($config);
        }
    }

}

?>
