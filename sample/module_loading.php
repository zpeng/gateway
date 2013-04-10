<?php

$JS_SHARED = array(
    "global_constants" => "includes/global_constants.js",

    "jquery-1.9.1" => "js/shared/jquery-1.9.1/jquery-1.9.1.min.js",
    "jquery-ui-1.10.2.js" => "js/shared/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js",

    "jquery-form-validate" => "js/shared/jquery-form-validate/jquery.validate.js",
    "jquery-form-validate-func" => "js/shared/jquery-form-validate/jquery.validation.functions.js",

    "underscore-1.4.4" => "js/shared/underscore-1.4.4/underscore-min.js",
    "backbone-1.0.0" => "js/shared/backbone-1.0.0/backbone-min.js",
    "tiny_mce-3.5.8" => "js/shared/tiny_mce-3.5.8/tiny_mce.js",

    "editablegrid" => array(
        "js/shared/editablegrid-2.0.1/editablegrid-2.0.1.js",
        "js/shared/editablegrid-2.0.1/editablegrid-2.0.1-extend.js"
    ),
);


$GLOBAL_DEPS = array(
    "system_code" => array(
        "module_name" => "System Core",
        "module_view_menu" => "admin/view/left_panel.php",
        "module_view_content" => "admin/view/right_panel.php",

        "php" => array(
            "Content" => "modules/cms/includes/classes/Content.php",
            "ContentManager" => "modules/cms/includes/classes/ContentManager.php",

            "Menu" => "modules/cms/includes/classes/Menu.php",
            "MenuType" => "modules/cms/includes/classes/MenuType.php",
            "MenuManager" => "modules/cms/includes/classes/MenuManager.php",
        ),

        "css" => array(
            "backend" => array(),

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

function output_js_dependencies($js_deps)
{
    foreach ($js_deps as $js) {
        if (is_array($js) && sizeof($js) > 0) {
            output_js_dependencies($js);
        } else {
            echo "<script type=\"text/javascript\" src=\"" . $js . "\"></script>";
        }
    }
}


echo output_js_dependencies($GLOBAL_DEPS["system_code"]["js"]["backend"]);


?>