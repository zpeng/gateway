<?php

define('PROJECT_FOLDER', "/gateway");

/** define base path */
if ( !defined('BASE_PATH') )
    define('BASE_PATH', str_replace('\\', '/', realpath($_SERVER["DOCUMENT_ROOT"]).PROJECT_FOLDER.'/') );

// disable error display
//ini_set('display_errors', '0');

// load all the dependency
include_once("dependency.php");
foreach ($module_list as $module ) {
    include_once(BASE_PATH.$module);
    //echo BASE_PATH.$module."<br/>";
}
unset( $module_list );



?>