<?php

//require_once 'IMigrator.php';

/**
 * Description of DbGenerate
 *
 * @author Paavo Soeiro
 */
class DbGenerate implements IAction {

    protected $migration_dir = "migrations";

//    $migration_dir;// = "";

    public function __construct() {
        /*
         * verify the existency of the migration dir
         * if not exists try to create
         */
        if (!is_dir($this->migration_dir)) {
            printf("\n\tMigrations directory (%s doesn't exist, attempting to create.", $this->migration_dir);
            if (mkdir($this->migration_dir) === FALSE) {
                printf("\n\tUnable to create migrations directory at %s, check permissions?", $this->migration_dir);
            } else {
                printf("\n\tCreated OK");
            }
        }
        /*
         * verify if the migration dir has permission to write
         */
        if (!is_writable($this->migration_dir)) {
            echo("ERROR: migration directory '" . $this->migration_dir . "' is not writable by the current user. Check permissions and try again.");
        }
    }

    public function run($migration) {
        $timestamp = $this->getTimestamp();
        $class = $this->convertName($migration);
        $path = $this->migration_dir . "/" . $timestamp . "_" . $class . ".php";
        $file_result = file_put_contents($path, $this->template($class));
        if ($file_result === FALSE) {
            echo("Error writing to migrations directory/file. Do you have sufficient privileges?");
        } else {
            echo "\n\tCreated migration: {$migration}\n\n";
        }
    }

    private function getTimestamp() {
        return gmdate('YmdHis', time());
    }

    private function template($class) {
        $template = <<<TEMPLATE
<?php\n
class $class extends MigracaoBase {
    
    public function up() {
        throw new Exception('Method up from $class not yet implemented');
    }

    public function down() {
        throw new Exception('Method down from $class not yet implemented');
    }
    
}

?>
TEMPLATE;
        return $template;
    }

    private function convertName($name) {
        $className = explode("_", $name);
        $retorno;
        array_walk($className, function ($value)use(&$retorno) {
                    $retorno[] = ucfirst($value);
                });
        return implode("", $retorno);
    }

}

?>
