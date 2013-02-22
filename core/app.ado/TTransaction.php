<?php

//classe para manipular transa��es

final class TTransaction {

    private static $conn;
    private static $logger;  //objeto LOG

    private function __construct() {
        
    }

    //abre conex�o com o DB

    public static function open($sgbd = '', $host = '', $db = '', $user = '', $pass = '', $trans = true) {
        if (empty(self::$conn)) {
//            if ((empty($user)) and (!empty($pass)) and (empty($db)) and (empty($host))) {
//                self::$conn = TConnection::open($sgbd, $host, $db, $user, $pass);
//            }else{
                self::$conn = TConnection::open(DBSGBD, DBHOST, DBNAME, DBUSER, DBPASS);
//            }
            //inicia a transa��o
            if ($trans == true) {
                self::$conn->StartTrans();
            }

            self::$logger = NULL;
        }
    }

    public static function openBase($base, $trans = true) {

        if (empty(self::$conn)) {
            self::$conn = TConnection::open($host, $db, $user, $pass);

            //inicia a transa��o
            if ($trans == true) {
                self::$conn->StartTrans();
            }

            self::$logger = NULL;
        }
    }

    //retorna a conex�o ativa

    public static function get() {
        return self::$conn;
    }

    //desfaz todas as opera��es realizadas

    public static function rollback() {
        if (self::$conn) {
            //self::$conn->RollbackTrans();
            TConnection::revertConnection(self::$conn);
            self::$conn = NULL;
        }
    }

    //aplica todas as altera��es realizadas e fecha a transa��o

    public static function close() {
        if (self::$conn) {
            //self::$conn->CommitTrans();
            TConnection::closeConnection(self::$conn);
            self::$conn = NULL;
        }
    }

    //define qual algoritmo de LOG usar

    public static function setLogger(TLogger $logger) {
        self::$logger = $logger;
    }

    //armazena uma mensagem no arquivo de LOG

    public static function log($message) {
        if (self::$logger) {
            self::$logger->write($message);
        }
    }

}

?>
