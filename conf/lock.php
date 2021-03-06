<?php

header('Content-Type: text/html; charset=utf-8');

if (file_exists('config.inc.php')) {
    include_once 'config.inc.php';
} elseif (file_exists('conf/config.inc.php')) {
    include_once 'conf/config.inc.php';
} elseif (file_exists('../conf/config.inc.php')) {
    include_once '../conf/config.inc.php';
} elseif (file_exists('../../conf/config.inc.php')) {
    include_once '../../conf/config.inc.php';
} elseif (file_exists('../../../conf/config.inc.php')) {
    include_once '../../../conf/config.inc.php';
}

if (file_exists('core/adodb5/adodb.inc.php')) {
    include_once 'core/adodb5/adodb.inc.php';
} elseif (file_exists('../core/adodb5/adodb.inc.php')) {
    include_once '../core/adodb5/adodb.inc.php';
} elseif (file_exists('../../core/adodb5/adodb.inc.php')) {
    include_once '../../core/adodb5/adodb.inc.php';
} elseif (file_exists('../../../core/adodb5/adodb.inc.php')) {
    include_once '../../../core/adodb5/adodb.inc.php';
}

function __autoload($classe) {
    if (file_exists('../../../core/app.ado/' . $classe . '.class.php')) {
        include_once '../../../core/app.ado/' . $classe . '.class.php';
    } elseif (file_exists('../../core/app.ado/' . $classe . '.class.php')) {
        include_once '../../core/app.ado/' . $classe . '.class.php';
    } elseif (file_exists('../core/app.ado/' . $classe . '.class.php')) {
        include_once '../core/app.ado/' . $classe . '.class.php';
    } elseif (file_exists('../app.ado/' . $classe . '.class.php')) {
        include_once '../app.ado/' . $classe . '.class.php';
    } elseif (file_exists('../../app.ado/' . $classe . '.class.php')) {
        include_once '../../app.ado/' . $classe . '.class.php';
    } elseif (file_exists('core/app.ado/' . $classe . '.class.php')) {
        include_once 'core/app.ado/' . $classe . '.class.php';
    } elseif (file_exists('../../../../core/app.ado/' . $classe . '.class.php')) {
        include_once '../../../../core/app.ado/' . $classe . '.class.php';
    } elseif (file_exists('../models/' . $classe . '.class.php')) {
        include_once '../models/' . $classe . '.class.php';
    } elseif (file_exists('app/models/' . $classe . '.class.php')) {
        include_once 'app/models/' . $classe . '.class.php';
    } elseif (file_exists('../app/models/' . $classe . '.class.php')) {
        include_once '../app/models/' . $classe . '.class.php';
    } elseif (file_exists('../../../app/models/' . $classe . '.class.php')) {
        include_once '../../../app/models/' . $classe . '.class.php';
    }

    if (file_exists('../controllers/' . $classe . '.php')) {
        include_once '../controllers/' . $classe . '.php';
    } elseif (file_exists('app/controllers/' . $classe . '.php')) {
        include_once 'app/controllers/' . $classe . '.php';
    } elseif (file_exists('../app/controllers/' . $classe . '.php')) {
        include_once '../app/controllers/' . $classe . '.php';
    } elseif (file_exists('../../app/controllers/' . $classe . '.php')) {
        include_once '../../app/controllers/' . $classe . '.php';
    } elseif (file_exists('../../../app/controllers/' . $classe . '.php')) {
        include_once '../../../app/controllers/' . $classe . '.php';
    } elseif (file_exists('../app/controllers/' . $classe . '.php')) {
        include_once '../app/controllers/' . $classe . '.php';
    }
}

session_start();
?>

