<?php
/** define the database **/
define('DB_HOST', "localhost");
define('DB_NAME', "olly");
define('DB_USER', "root");
define('DB_PASSWORD', "");


/** define SMTP related */
define('SMTP_SERVER', "auth.smtp.1and1.co.uk");
define('SMTP_USER', "admin@dealsteal.co");
define('SMTP_PASSWORD', "19840617");
define('SMTP_PORT', "25");

/** define server and project location - used to load css and js files **/
define('SERVER_URL', "http://localhost/gateway/");
define('PROJECT_FOLDER', "/gateway"); // in case the project folder is sub-folder of the root folder

/** define base path - used for loading php files */
if (!defined('BASE_PATH'))
    define('BASE_PATH', str_replace('\\', '/', realpath($_SERVER["DOCUMENT_ROOT"]) . PROJECT_FOLDER . '/'));


//disable error display
ini_set('display_errors', '1');


$GLOBAL_DEPS = array();

// loading the core deps
include_once(BASE_PATH . "includes/global_deps.php");


// reads the module config and loads each module deps
include_once("module_deps_config.php");
foreach ($MODULE_DEPS_LIST as $module_key => $module_deps) {
    include_once(BASE_PATH . $module_deps);
    $GLOBAL_DEPS = array_merge($GLOBAL_DEPS, array(
        "$module_key" => $module_config
    ));
}

//print_r($GLOBAL_DEPS);

// now loads all the required php files for all the available modules
foreach ($GLOBAL_DEPS as $module_key => $module_deps_config) {
    foreach ($GLOBAL_DEPS[$module_key]["php"] as $php_deps) {
        include_once(BASE_PATH . $php_deps);
        //echo BASE_PATH . $php_file . "<br/>";
    }
}


// Or, using an anonymous function as of PHP 5.3.0
// auto loader register for auto loading php classes
spl_autoload_register(function ($class) {
    // get full name of file containing the required class
    $file = BASE_PATH.str_replace('\\', '/', $class) . '.php';
    // get file if it is readable
    if (is_readable($file))
        require_once $file;
});

?>