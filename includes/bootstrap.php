<?php
/** define the database **/
define('DB_HOST', "localhost");
define('DB_NAME', "olly");
define('DB_USER', "root");
define('DB_PASSWORD', "");


/** define server and project location - used to load css and js files **/
define('SERVER_URL', "http://localhost/gateway/");
define('PROJECT_FOLDER', "/gateway");

/** define base path - used for loading php files */
if (!defined('BASE_PATH'))
    define('BASE_PATH', str_replace('\\', '/', realpath($_SERVER["DOCUMENT_ROOT"]) . PROJECT_FOLDER . '/'));


//disable error display
//ini_set('display_errors', '0');

// loading the core deps
include_once(BASE_PATH . "includes/deps.php");

// reads the module config and loads each module deps
include_once("module_deps_config.php");
foreach ($MODULE_DEPS_CONFIG_LIST as $module_deps) {
    include_once(BASE_PATH . $module_deps);
    //echo BASE_PATH . $module_deps . "<br/>";
}

// now you have all the phps you need
foreach ($PHP_MODULE_LIST as $module) {
    include_once(BASE_PATH . $module);
    //echo BASE_PATH . $module . "<br/>";
}
unset($PHP_MODULE_LIST);


?>