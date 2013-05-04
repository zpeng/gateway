<?php

$CSS_SHARED = array(
    "admin_css" => "admin/css/admin.css",
    "jquery-ui-1.10.2.custom.css" => "js/shared/jquery-ui-1.10.2.custom/css/custom-theme/jquery-ui-1.10.2.custom.css",
    "jquery-form-validate-css" => "js/shared/jquery-form-validate/jquery.validate.css",
    "editablegrid_css" => "js/shared/editablegrid-2.0.1/editablegrid-2.0.1.css",
    "tiny_mce-3.5.8-skin-ui" => "js/shared/tiny_mce-3.5.8/themes/advanced/skins/default/ui.css",
    "jstree_style" => "js/shared/jstree-v.pre1.0/themes/default/style.css",
    "jquery-tag-css" => "js/shared/jquery-tags/jquery.tagsinput.css"
);

$JS_SHARED = array(
    "global_constants" => "includes/global_constants.js",

    "jquery-1.9.1" => "js/shared/jquery-1.9.1/jquery-1.9.1.min.js",
    "jquery-ui-1.10.2.js" => "js/shared/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js",

    "underscore-1.4.4" => "js/shared/underscore-1.4.4/underscore-min.js",
    "backbone-1.0.0" => "js/shared/backbone-1.0.0/backbone-min.js",

    "jquery-form-validate" => array(
        "js/shared/jquery-form-validate/jquery.validate.js",
        "js/shared/jquery-form-validate/jquery.validation.functions.js"
    ),

    "jsTree" => array(
        "js/shared/jstree-v.pre1.0/jquery.jstree.js",
        "js/shared/jstree-v.pre1.0/_lib/jquery.hotkeys.js",
        "js/shared/jstree-v.pre1.0/_lib/jquery.cookie.js"
    ),

    "jquery-tag" => "js/shared/jquery-tags/jquery.tagsinput.min.js",

    "jquery-ui-timepicker" => "js/shared/jquery-plugin/jquery-ui-timepicker-addon.js",

    "tiny_mce-3.5.8" => "js/shared/tiny_mce-3.5.8/tiny_mce.js",

    "editablegrid" => array(
        "js/shared/editablegrid-2.0.1/editablegrid-2.0.1.js",
        "js/shared/editablegrid-2.0.1/editablegrid-2.0.1-extend.js"),

    "admin_ui" => "admin/js/admin_ui.js"
);


$GLOBAL_DEPS = array(
    "shared_php" => array(
        "php" => array(
            "PageBuilder" => "includes/page_builder.php",
            "DatabaseUtils" => "includes/database_utils.php",
            "GlobalFunction" => "includes/utils/global_functions.php",
            "HtmlWidgets" => "includes/ui/html_widgets.php",
            "FileUploader" => "includes/classes/FileUploader.php",
        )
    )
)

?>
