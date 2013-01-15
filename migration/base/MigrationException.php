<?php

/**
 * Classes para lançar exceções
 *
 * @author Lorrane
 */
class PrimaryKeyAlreadyExistsException extends Exception {

    function __construct($msg = "A chave primaria ja esta definida para esta tabela", $code = 0) {
        parent::__construct($msg, $code);
    }

}

class TableNameNotDefinedException extends Exception {

    function __construct($msg = "Nome da tabela nao informado", $code = 0) {
        parent::__construct($msg, $code);
    }

}

class AdapterNotDefinedException extends Exception {

    function __construct($msg = "Adaptador não definido", $code = 0) {
        parent::__construct($msg, $code);
    }

}

class ReferenceTableNotDefinedExption extends Exception {

    function __construct($msg = "Nome da tabela referencia nao definido.", $code = 0) {
        parent::__construct($msg, $code);
    }

}

class ColumnNotExistsException extends Exception {

    function __construct($msg = "Coluna nao existe.", $code = 0) {
        parent::__construct($msg, $code);
    }

}

?>
