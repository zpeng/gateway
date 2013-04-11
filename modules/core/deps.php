<?php
$module_config = array(
    "module_name" => "System Core",
    "module_view_menu" => "modules/core/admin/view/left_panel.php",
    "module_view_content" => "modules/core/admin/view/right_panel.php",

    "php" => array(
        "User" => "modules/core/includes/classes/User.php",
        "UserManager" => "modules/core/includes/classes/UserManager.php",
        "UserSession" => "modules/core/includes/classes/UserSession.php",

        "Configuration" => "modules/core/includes/classes/Configuration.php",
        "ConfigurationManager" => "modules/core/includes/classes/ConfigurationManager.php",

        "Module" => "modules/core/includes/classes/Module.php",
        "ModuleManager" => "modules/core/includes/classes/ModuleManager.php",
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
);