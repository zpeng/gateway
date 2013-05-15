<?php
$module_config = array(
    "module_name" => "System Core",
    "module_logo" => "modules/core/images/core-logo.png",
    "module_view_menu" => "modules/core/view/left_panel.php",
    "module_view_content" => "modules/core/view/right_panel.php",

    "php" => array(),
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