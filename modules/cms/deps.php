<?php

$module_config = array(
    "module_name" => "Content Manager",
    "module_logo" => "modules/cms/admin/images/cms-logo.gif",
    "module_view_menu" => "modules/cms/admin/view/left_panel.php",
    "module_view_content" => "modules/cms/admin/view/right_panel.php",

    "php" => array(
        "Content" => "modules/cms/includes/classes/Content.php",
        "ContentManager" => "modules/cms/includes/classes/ContentManager.php",

        "Menu" => "modules/cms/includes/classes/Menu.php",
        "MenuType" => "modules/cms/includes/classes/MenuType.php",
        "MenuManager" => "modules/cms/includes/classes/MenuManager.php",
    ),

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