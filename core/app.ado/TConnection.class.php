<?php

/* classe para gerenciar
 * as conex�es com o DB atrav�s de arquivos de configura��o
 */

final class TConnection {

    protected static $db;

    private function __construct() {
        
    }

    /* Metodo open()
     * recebe os parametros do DB e instancia um objeto ADODB
     */

    public static function open($sgbd = '', $host = '', $db = '', $user = '', $pass = '') {
        $conn = ADONewConnection($sgbd);
        TConnection::$db = $sgbd;
        $conn->debug = true; // coloca o debug como ativo

        if ((empty($user)) and (empty($pass)) and (empty($db)) and (empty($host))) {
            if ($sgbd !== "oci8") {
                if ($conn->PConnect(DBHOST, DBUSER, DBPASS, DBNAME)) {
                    return $conn;
                } else {
                    return false;
                }
            } else {
                if ($conn->PConnect(DBNAME, DBUSER, DBPASS)) {
                    return $conn;
                } else {
                    return false;
                }
            }
        } else {
            if ($sgbd !== "oci8") {
                if ($conn->PConnect($host, $user, $pass, $db)) {
                    return $conn;
                } else {
                    return false;
                }
            } else {
                if ($conn->PConnect($db, $user, $pass)) {
                    return $conn;
                } else {
                    return false;
                }
            }
        }
    }

    public static function closeConnection($conn) {
//        if (TConnection::$db == "mssqlnative") {
//            $conn->Execute('GO');
//        } else {
        $conn->CompleteTrans();
//        }
    }

    public static function revertConnection($conn) {
        $conn->Execute('ROLLBACK');
    }

}

?>
