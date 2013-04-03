<?php
$PHP_MODULE_LIST = array(
    "User" => "includes/classes/User.php",
    "UserManager" => "includes/classes/UserManager.php",
    "UserSession" => "includes/classes/UserSession.php",

    "Configuration" => "includes/classes/Configuration.php",
    "ConfigurationManager" => "includes/classes/ConfigurationManager.php",

    "Module" => "includes/classes/Module.php",
    "ModuleManager" => "includes/classes/ModuleManager.php",

    "PageBuilder" => "includes/page_builder.php",
    "DatabaseUtils" => "includes/database_utils.php",
    "GlobalFunction" => "includes/utils/global_functions.php",
);

$CSS_SHARED_LIST = array(
    "backgrid_css" => "js/shared/backgrid-0.2.0/backgrid.min.css"
);

$CSS_BACKEND_LIST = array_merge($CSS_SHARED_LIST, array(
    "admin_css" => "admin/css/admin.css",


));

$CSS_FRONTEND_LIST = array_merge($CSS_SHARED_LIST, array(

));

$JS_SHARED_LIST = array(
    "jquery-1.9.1" => "js/shared/jquery-1.9.1/jquery-1.9.1.min.js",
    "underscore-1.4.4" => "js/shared/underscore-1.4.4/underscore-min.js",
    "backbone-1.0.0" => "js/shared/backbone-1.0.0/backbone-min.js",


    "tiny_mce-3.5.8" => "js/shared/tiny_mce-3.5.8/tiny_mce.js",
    "backgrid-0.2.0" => "js/shared/backgrid-0.2.0/backgrid.min.js",
);

$JS_BACKEND_LIST = [];
$JS_FRONTEND_LIST = [];

$JS_BACKEND_LIST = array_merge($JS_SHARED_LIST, array());

$JS_FRONTEND_LIST = array_merge($JS_SHARED_LIST, array());


?>
