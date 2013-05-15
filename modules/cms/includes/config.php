<?php

$module_config = array(
    "module_name" => "Content Manager",
    "module_logo" => "modules/cms/images/cms-logo.gif",
    "module_view_menu" => "modules/cms/view/left_panel.php",
    "module_view_content" => "modules/cms/view/right_panel.php",

    "php" => array(),

    "css" => array(
        "backend" => array_merge($CSS_SHARED, array()),
        "frontend" => array()
    ),

    "js" => array(
        "backend" => array_merge($JS_SHARED, array()),
        "frontend" => array()
    )
);

?>