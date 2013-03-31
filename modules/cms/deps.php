<?php
$PHP_MODULE_LIST = array_merge($PHP_MODULE_LIST, array(
    "Content" => "modules/cms/includes/classes/Content.php",
    "ContentDescription" => "modules/cms/includes/classes/ContentDescription.php",
    "ContentManager" => "modules/cms/includes/classes/ContentManager.php",

    "Menu" => "modules/cms/includes/classes/Menu.php",
    "MenuType" => "modules/cms/includes/classes/MenuType.php",
    "MenuDescription" => "modules/cms/includes/classes/MenuDescription.php",
    "MenuManager" => "modules/cms/includes/classes/MenuManager.php",

    "Language" => "modules/cms/includes/classes/Language.php",
    "LanguageDefault" => "modules/cms/includes/classes/LanguageDefault.php",
    "LanguageManager" => "modules/cms/includes/classes/LanguageManager.php",
));


$CSS_BACKEND_LIST = array_merge($CSS_BACKEND_LIST, array(
    // define the backend css files which are required for the cms module
));

$CSS_FRONTEND_LIST = array_merge($CSS_FRONTEND_LIST, array(
    // define the front-end css files which are required for the cms module
));


$JS_BACKEND_LIST = array_merge($JS_BACKEND_LIST, array(
    "jquery1.9.1" => "js/shared/jquery/jquery-1.9.1.min.js"
));


$JS_FRONTEND_LIST = array_merge($JS_FRONTEND_LIST, array(
));


?>