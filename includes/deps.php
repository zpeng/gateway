<?php
$PHP_CORE_LIST = array(
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
    "HtmlFunction" => "includes/ui/html_functions.php",
);

$CSS_SHARED_LIST = array(
    "admin_css" => "admin/css/admin.css",

    "editablegrid_css" => "js/shared/editablegrid-2.0.1/editablegrid-2.0.1.css"
);

$JS_SHARED_LIST = array(
    "jquery-1.9.1" => "js/shared/jquery-1.9.1/jquery-1.9.1.min.js",
    "underscore-1.4.4" => "js/shared/underscore-1.4.4/underscore-min.js",
    "backbone-1.0.0" => "js/shared/backbone-1.0.0/backbone-min.js",

    "tiny_mce-3.5.8" => "js/shared/tiny_mce-3.5.8/tiny_mce.js",

    "editablegrid" => "js/shared/editablegrid-2.0.1/editablegrid-2.0.1.js",
    "editablegrid-extend" => "js/shared/editablegrid-2.0.1/editablegrid-2.0.1-extend.js"

);


$GLOBAL_DEPS = array(
    "a74ad8dfacd4f985eb3977517615ce25" => array(
        "module_name" => "System Core",
        "module_view_menu" => "admin/view/left_panel.php",
        "module_view_content" => "admin/view/right_panel.php",
        "php_list" => $PHP_CORE_LIST,
        "css_backend_list" => array_merge($CSS_SHARED_LIST, array()),
        "css_frontend_list" => array_merge($CSS_SHARED_LIST, array()),
        "js_backend_list" => array_merge($JS_SHARED_LIST, array()),
        "js_frontend_list" => array_merge($JS_SHARED_LIST, array())
    )
);

?>
