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
    //"backgrid_css" => "js/shared/backgrid-0.2.0/backgrid.min.css",
    //"backgrid-paginator_css"=>"js/shared/backgrid-0.2.0/extensions/paginator/backgrid-paginator.css",

    "admin_css" => "admin/css/admin.css",

    "tiny_table_css" => "js/shared/tiny_table/tiny_table.css"
);

$JS_SHARED_LIST = array(
    "jquery-1.9.1" => "js/shared/jquery-1.9.1/jquery-1.9.1.min.js",
    "underscore-1.4.4" => "js/shared/underscore-1.4.4/underscore-min.js",
    "backbone-1.0.0" => "js/shared/backbone-1.0.0/backbone-min.js",

    "tiny_mce-3.5.8" => "js/shared/tiny_mce-3.5.8/tiny_mce.js",

    "tiny_table" => "js/shared/tiny_table/tiny_table.js",

    //backgrid related
    //"backgrid-0.2.0" => "js/shared/backgrid-0.2.0/backgrid.min.js",
    //"backgrid-0.2.0-pageable" => "js/shared/backgrid-0.2.0/assets/js/backbone-pageable.js",
    //"backgrid-0.2.0-pageable-js" => "js/shared/backgrid-0.2.0/extensions/paginator/backgrid-paginator.js",
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
