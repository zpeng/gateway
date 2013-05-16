<?php
$module_config = array(
    "module_name" => "System Core",
    "module_logo" => "modules/core/images/core-logo.png",
    "module_view_menu" => "modules/core/view/left_panel.php",
    "module_view_content" => "modules/core/view/right_panel.php",

    "php" => array(),
    "css" => array(
        "backend" => array(
            "admin_css" => "admin/css/admin.css"
        ),
        "frontend" => array()
    ),

    "js" => array(
        "backend" => array_merge($JS_GLOBAL, array()),
        "frontend" => array()
    )
);