<?php

/**
 * Description of TMigration
 *
 * @author Paavo Soeiro
 */
interface IMigration {
    function up();
    function down();
}

?>
