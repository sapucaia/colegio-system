<?php

//require_once 'IMigrator.php';
//require_once '../adapters/AdapterFactory.php';
//require_once '../../conf/lock.php';

/**
 * Description of DbMigrate
 *
 * @author Paavo Soeiro
 */
class DbMigrate implements IAction {

    private $adapter;
    private $migrations;
    protected $distributed = false;
    protected $direction;
    protected $executadas;

    public function __construct($adapter_name = null, $db = null) {
//        $this->adapter = $adapter;
        if ($adapter_name != null)
            $this->adapter = AdapterFactory::getAdapter($adapter_name, $db);
//        $this->migrations = $this->loadMigrations();
    }

    public function setDirection($direction) {
        $this->direction = $direction;
    }

    public function setAdapter($adapter) {
        $this->adapter = $adapter;
    }

    public function setDistributed($distributed) {
        $this->distributed = $distributed;
        if ($distributed === false) {
            $this->adapter->setDefaultBase();
        } else {
            $this->adapter->createDatabaseLinks();
        }
    }

    public function run($param = null) {

//        $this->migrate($this->loadMigrations());
        $this->migrar($this->loadMigrations());
    }

    private function migrar($migrations) {
        foreach ($migrations as $migration) {
            require_once "migrations/" . $migration['file'];
//            $migracao = str_replace(".php", "", $migration);
            $migracao = new $migration['class']($this->adapter);

            /*
             * execute migration for each base in $bases
             * database distributed
             */

            if ($this->distributed) {

                foreach ($migracao->bases as $base) {
                    $this->adapter->setBase($base);
                    /*
                     * verify if schema version already been created
                     * verify if this migration already been executed
                     */

//                    if (!$this->adapter->tableExists('schema')) {
//                        $this->createSchema();
//                    }
//                    /*
//                     * if migration has been executed go on
//                     */
//                    $executadas = $this->adapter->getExecutedMigrations();
//                    if (in_array($migration['version'], $executadas)) {
//                        continue;
//                    }
//                    $migracao->up();
//                    /*
//                     * update schema version for this base
//                     */
//                    $this->adapter->updateSchemaVersion($migration['version']);

                    $this->execute_migration($migration, $migracao);
                }
                /*
                 * not distributed
                 */
            } else {
//                $this->adapter->setDefaultBase();
//                if (!$this->adapter->tableExists('schema')) {
//                    $this->createSchema();
//                }
//                $executadas = $this->adapter->getExecutedMigrations();
//                if (in_array($migration['version'], $executadas)) {
//                    continue;
//                }
//                $migracao->up();
//                $this->adapter->updateSchemaVersion($migration['version']);
                $this->execute_migration($migration, $migracao);
            }
            //update schema
//            $this->adapter->updateSchemaVersion($migration['version']);
        }
        printf("Migracao executada com sucesso!");
    }

    private function execute_migration($migration, MigracaoBase $migracao) {
        if (!$this->adapter->tableExists('schema')) {
            $this->createSchema();
        }
        if (!$this->adapter->tableExists('schema_table')) {
            $this->createSchemaTable();
        }
        if (!$this->adapter->tableExists('schema_reference')) {
            $this->createSchemaReference();
        }
        if (!$this->adapter->tableExists('schema_sequence')) {
            $this->createSchemaSequence();
        }

        //version of migration - timestamp
        $this->executadas = $this->adapter->getExecutedMigrations();

        if ($this->direction === 'up') {
            /*
             * if migration has been executed go to next
             */
            if (in_array($migration['version'], $this->executadas)) {
                echo "Migration {$migration['class']} already executed";
                return;
            }
            try {
                $migracao->up();

//                printf("Migration %s executed at %s \n", $migration['class'], gmdate('H:i:s d/m/Y', time()));
//                echo "Migration {$migration['class']} executed at ";
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return;
            }
            /*
             * update schema version for this base
             */
            $this->adapter->updateSchemaVersion($migration['version']);
        } else {
            if (!in_array($migration['version'], $this->executadas)) {
                return;
            }

            try {
                $migracao->down();
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return;
            }
            /*
             * down schema version for this base
             */
            $this->adapter->downSchemaVersion($migration['version']);
        }
    }

    private function loadMigrations() {
//        $this->migrations = scandir("../migrations");
        $migrations = scandir("migrations");
        unset($migrations[0]);
        unset($migrations[1]);
//        array_diff($this->migrations, array(".", ".."));
//        array_walk($this->migrations, function (){});
        $regex = '/^(\d+)_(.*)\.php$/';
//        if(preg_match($regex, , $matches))
        if ($this->direction === 'down') {
            rsort($migrations);
        } else {
            sort($migrations);
        }
        $matches = null;
        foreach ($migrations as $migration) {
            if (preg_match($regex, $migration, $matches)) {
                if (ereg('Migrate', $matches[0]))
                    continue;
                $this->migrations[] = array('file' => $matches[0],
                    'version' => $matches[1],
                    'class' => $matches[2]);
            }
        }

        return $this->migrations;
//        foreach ($files as $file) {
//            
//        }
    }

    private function createSchema() {
        $t = $this->adapter->createTable('schema', array('id' => false));
        $t->column('string', 'version', array('unique' => true));
        $t->skipUpdateSchema();
        $t->end();
    }

    private function createSchemaTable() {
        $t = $this->adapter->createTable('schema_table', array('id' => false));
        $t->column('string', 'table_name', array('unique' => true));
        $t->skipUpdateSchema();
        $t->end();
    }

    private function createSchemaReference() {
        $t = $this->adapter->createTable('schema_reference');
        $t->column('string', 'table_name');
        $t->column('string', 'table_target');
        $t->column('string', 'column_name');
        $t->column('string', 'column_target');
        $t->skipUpdateSchema();
        $t->end();
    }

    private function createSchemaSequence() {
        $t = $this->adapter->createTable('schema_sequence');
        $t->column('string', 'table_name');
        $t->column('string', 'sequence_name');
//        $t->column('string', 'column_name');
//        $t->column('string', 'column_target');
        $t->skipUpdateSchema();
        $t->end();
    }

}

?>
