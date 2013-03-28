<?php

/** define the database **/
define('DB_HOST', "localhost");
define('DB_NAME', "gateway");
define('DB_USER', "root");
define('DB_PASSWORD', "");



/** define server and project location **/
define('SERVER_URL', "http://localhost/gateway/");
define('PROJECT_FOLDER', "/gateway");


/** define base path */
if ( !defined('BASE_PATH') )
    define('BASE_PATH', str_replace('\\', '/', realpath($_SERVER["DOCUMENT_ROOT"]).PROJECT_FOLDER.'/') );


// disable error display
//ini_set('display_errors', '0');

// load all the dependency
include_once("dependency.php");
foreach ($PHP_MODULE_LIST as $module ) {
    include_once(BASE_PATH.$module);
    //echo BASE_PATH.$module."<br/>";
}
unset($PHP_MODULE_LIST);


?>