<?php

$CSS_SHARED = array(
    "admin_css" => "admin/css/admin.css",
    "jquery-ui-1.10.2.custom.css" => "js/shared/jquery-ui-1.10.2.custom/css/custom-theme/jquery-ui-1.10.2.custom.css",
    "jquery-form-validate-css" => "js/shared/jquery-form-validate/jquery.validate.css",
    "editablegrid_css" => "js/shared/editablegrid-2.0.1/editablegrid-2.0.1.css",
    "tiny_mce-3.5.8-skin-ui" => "js/shared/tiny_mce-3.5.8/themes/advanced/skins/default/ui.css",
);

$JS_SHARED = array(
    "global_constants" => "includes/global_constants.js",

    "jquery-1.9.1" => "js/shared/jquery-1.9.1/jquery-1.9.1.min.js",
    "jquery-ui-1.10.2.js" => "js/shared/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js",

    "underscore-1.4.4" => "js/shared/underscore-1.4.4/underscore-min.js",
    "backbone-1.0.0" => "js/shared/backbone-1.0.0/backbone-min.js",

    "jquery-form-validate" => array("js/shared/jquery-form-validate/jquery.validate.js",
        "js/shared/jquery-form-validate/jquery.validation.functions.js"),


    "tiny_mce-3.5.8" => "js/shared/tiny_mce-3.5.8/tiny_mce.js",

    "editablegrid" => array("js/shared/editablegrid-2.0.1/editablegrid-2.0.1.js",
        "js/shared/editablegrid-2.0.1/editablegrid-2.0.1-extend.js"),

    "admin_ui" => "admin/js/admin_ui.js"
);


$GLOBAL_DEPS = array(
    "a74ad8dfacd4f985eb3977517615ce25" => array(
        "module_name" => "System Core",
        "module_view_menu" => "admin/view/left_panel.php",
        "module_view_content" => "admin/view/right_panel.php",

        "php" => array(
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
        ),

        "css" => array(
            "backend" => array_merge($CSS_SHARED, array()),
            "frontend" => array()
        ),

        "js" => array(
            "backend" => array_merge($JS_SHARED, array(
                "admin_ui" => "admin/js/admin_ui.js"
            )),
            "frontend" => array()
        )
    )
);

?>
