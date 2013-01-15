<?php

//require_once '../adapters/PostgresMigrationAdapter.php';
//require_once '../adapters/AdapterFactory.php';
//require_once '../action/DbMigrate.php';
//require_once '../../conf/lock.php';

/**
 * Description of Migrator
 *
 * @author Paavo Soeiro
 */
class Migrate implements ICommand {

    private $action;
    private $adapter;
    private $distributed = false;
    private $direction = false;

    public function __construct($args, $config_db = null) {
        $tool = $args[1];
        $temp = explode(":", $tool);
        $temp[0] = ucfirst($temp[0]);
        $temp[1] = ucfirst($temp[1]);
        if (empty($temp[2])) {
            $this->direction = 'up';
        } else {
            $this->direction = $temp[2];
        }
        $this->action = implode("", array($temp[0], $temp[1]));


//        if (isset($args[2])) {
        //migracao distribuida
        if ($args[2] === "distributed") {
            $db = $config_db["distributed"]["development"];
            $this->distributed = true;
        } else {
            $db = $config_db["development"];
        }
        //data migration
//        } else {
//            $db = $config_db["data_migration"];
//        }
//        print_r($db);
//        $adapter = $this->getAdapter($db["adapter"]);
        $this->adapter = AdapterFactory::getAdapter($db["adapter"], $db);
//        $this->adapter = new $adapter($config_db);
//        $this->action = new $action($db["adapter"], $db);
//        $this->adapter = $db["adapter"];
////        $this->action = new $action($this->adapter);
//        $this->action->setDistributed($this->distributed);
////        exit();
//        $this->action->setDirection($direction);
    }
    
    public function __get($propriedade) {
        return $this->$propriedade;
    }

    public function execute() {
        $this->action->run();
    }

    public function setAction($action) {
        $this->action = $action;

        $this->action->setAdapter($this->adapter);
//        $this->action = new $action($this->adapter);
        $this->action->setDistributed($this->distributed);
//        exit();
        $this->action->setDirection($this->direction);
    }

}

?>
