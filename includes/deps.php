<?php
$PHP_MODULE_LIST = array(
    "Administrator" => "includes/classes/Administrator.php",
    "AdministratorManager" => "includes/classes/AdministratorManager.php",

    "ConfigurationEntity" => "includes/classes/ConfigurationEntity.php",
    "ConfigurationGroup" => "includes/classes/ConfigurationGroup.php",
    "ConfigurationManager" => "includes/classes/ConfigurationManager.php",

    "PageBuilder" => "includes/page_builder.php",
    "DatabaseUtils" => "includes/database_utils.php",
    "CommonFunction" => "includes/utils/common_functions.php",
);

$CSS_BACKEND_LIST = array(
    "admin_css" => "admin/css/admin.css",
);

$CSS_FRONTEND_LIST = array(
    "front_css" => "",
);

$JS_SHARED_LIST = array(
    "tiny_mce_3.5.8" => "js/shared/tiny_mce_3.5.8/tiny_mce.js",
);

$JS_BACKEND_LIST = [];
$JS_FRONTEND_LIST =[];

$JS_BACKEND_LIST = array_merge($JS_SHARED_LIST, array(
));

$JS_FRONTEND_LIST = array_merge($JS_SHARED_LIST, array(
));


?>
