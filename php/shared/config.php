<?php

/** define base path */
if ( !defined('BASE_PATH') )
    define('BASE_PATH', $_SERVER["SERVER_ADDR"] . '/gateway/');

// disable error display
//ini_set('display_errors', '0');

// load all the dependency
include_once("dependency.php");
foreach ($module_list as $module ) {
    include_once($module);
    echo BASE_PATH.$module."<br/>";
}
unset( $module_list );



?>