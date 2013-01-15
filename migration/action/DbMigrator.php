<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbMigrator
 *
 * @author Paavo Soeiro
 */
class DbMigrator implements IAction {

    private $migrations;
    private $db;
    private $adapterOrigin;
    private $adapterDesine;

    public function __construct() {
        
    }

    public function setDB($db) {
        $this->db = $db;
    }

    public function run($param = null) {
        $this->migrations = $this->loadMigrations();
        foreach ($this->migrations as $migration) {
            require_once "migrations/" . $migration['file'];
            $migracao = new $migration['class'];

            $host_migration = $migracao->up();
            $keys = array_keys($host_migration[1]);
            $adapterOrigin = AdapterFactory::getAdapter($this->db[$host_migration[0]]['adapter'], $this->db);
            $adapterDestine = AdapterFactory::getAdapter($this->db[$keys[0]]['adapter'], $this->db);

            $adapterOrigin->setBase($host_migration[0]);
            $adapterDestine->setBase($keys[0]);
//            $key = array
            if ($host_migration[1][0] === null)
                $tables = $adapterOrigin->getTables();
            else {
                foreach ($host_migration[1][$keys[0]] as $table)
                    $tables[] = $adapterOrigin->getTables($table);
            }

            foreach ($tables as $table) {
                if (!array_key_exists($table->TABLE_NAME, $tables))
                    $inserts[$table->TABLE_NAME] = $table->TABLE_NAME;
                $refs = $adapterOrigin->getReferences($table->TABLE_NAME);

                foreach ($refs as $reference) {
//                    $key = array_search($reference->TABLE_TARGET, $host_migration[1][$keys[0]]);
//                    if ($key === false) {
//                        throw new Exception("Existe uma dependencia para {$table->TABLE_NAME}, adicione a tabela {$reference->TABLE_TARGET} a migracao {$migration['class']}");
//                    }
                    if (!array_key_exists($reference->TABLE_TARGET, $inserts))
                        $inserts = Utils::array_insert_before($table->TABLE_NAME, $inserts, $reference->TABLE_TARGET, $reference->TABLE_TARGET);
                }
            }
//            print_r($inserts);

            foreach ($inserts as $insert) {
                $database_data[$insert] = $adapterOrigin->select($insert);
            }
//            foreach ($database_data as $data) {
//                echo "LINHA " . $data . "<br>";
//            }

            $i = 0;
            foreach ($inserts as $inserir) {
//                $sql = "BEGIN TRANSACTION \n ";
                foreach ($database_data[$inserir] as $data) {
//                    $adapterDestine->disableSequencies($inserir);
//                        echo "LINHA " . $data . "<br>";
                    $adapterDestine->insert($inserir, $data);
//                    $adapterDestine->enableSequencies($inserir);
                    }
            }
            printf("Data Migration Executed at %s", gmdate('H:i:s d/m/Y', time()));
        }
    }

    private function loadMigrations() {
        $migrations = scandir("migrations");
        unset($migrations[0]);
        unset($migrations[1]);
        $regex = '/^(\d+)_(.*)\.php$/';
        $matches = null;
        foreach ($migrations as $migration) {
            if (preg_match($regex, $migration, $matches)) {
                if (ereg('Migrate', $matches[0])) {
                    $this->migrations[] = array('file' => $matches[0],
                        'version' => $matches[1],
                        'class' => $matches[2]);
                }
            }
        }
        return $this->migrations;
    }

}

?>
