<?php

/*
$CSS_BACKEND_LIST = array_merge($CSS_BACKEND_LIST, array( // define the backend css files which are required for the cms module
));

$CSS_FRONTEND_LIST = array_merge($CSS_FRONTEND_LIST, array( // define the front-end css files which are required for the cms module
));


$JS_BACKEND_LIST = array_merge($JS_BACKEND_LIST, array());


$JS_FRONTEND_LIST = array_merge($JS_FRONTEND_LIST, array());
*/

$module_config = array(
    "module_name" => "Content Manager",
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