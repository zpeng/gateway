<?php

$CSS_DEPS = array(
    "jquery-ui-css" => array("external/js/jquery-ui-1.10.2.custom/css/custom-theme/jquery-ui-1.10.2.custom.css"),
    "jquery-form-validate-css" => array("external/js/jquery-form-validate/jquery.validate.css"),
    "editablegrid-css" => array("external/js/editablegrid-2.0.1/editablegrid-2.0.1.css"),
    "tiny_mce-css" => array("external/js/tiny_mce-3.5.8/themes/advanced/skins/default/ui.css"),
    "jstree-css" => array("external/js/jstree-v.pre1.0/themes/default/style.css"),
    "jquery-tag-css" => array("external/js/jquery-tags/jquery.tagsinput.css"),
    "jquery-CircularContentCarousel-css" => array("external/js/CircularContentCarousel/css/jquery.jscrollpane.css"),
    "fullcalendar-css" => array("external/js/FullCalendar-1.6.1/fullcalendar/fullcalendar.css",
        "external/js/FullCalendar-1.6.1/fullcalendar/fullcalendar.print.css"),
    "slickgrid-css" => array("external/js/SlickGrid/slick.grid.css",
        //"external/js/SlickGrid/css/smoothness/jquery-ui-1.8.16.custom.css",
        "external/js/jquery-ui-1.10.2.custom/css/custom-theme/jquery-ui-1.10.2.custom.css"),
    "rateit-css" => array("external/js/rateit/src/rateit.css","external/js/rateit/src/bigstars.css"),
);

/*
 * The following dependencies will be loaded by force
 */
$JS_GLOBAL = array(
    "global_constants" => "includes/global_constants.js",
    "jquery-1.9.1" => "external/js/jquery-1.9.1/jquery-1.9.1.min.js",
    "headJs" => "external/js/headJs/head.min.js"
    //"underscore-1.4.4" => "external/js/underscore-1.4.4/underscore-min.js",
    //"backbone-1.0.0" => "external/js/backbone-1.0.0/backbone-min.js"
);

$JS_FRONTEND = array(
    "global_constants" => "includes/global_constants.js",
    "jquery-1.9.1" => "external/js/jquery-1.9.1/jquery-1.9.1.min.js",
    "headJs" => "external/js/headJs/head.min.js",
    "jquery-hashchange" => array("external/js/jquery-hashchange/jquery.hashchange.min.js"),
    "jquery-easytabs" => array("external/js/jquery-easytabs/jquery.easytabs.min.js"),
);


/*
 * The following dependencies will be loaded on demand
 */
$JS_DEPS = array(
    "jquery-ui" => array(
        "external/js/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js"
    ),

    "jquery-form-validate" => array(
        "external/js/jquery-form-validate/jquery.validate.js",
        "external/js/jquery-form-validate/jquery.validation.functions.js"
    ),

    "jsTree" => array(
        "external/js/jstree-v.pre1.0/jquery.jstree.js",
        "external/js/jstree-v.pre1.0/_lib/jquery.hotkeys.js",
        "external/js/jstree-v.pre1.0/_lib/jquery.cookie.js"
    ),

    "jquery-tag" => array("external/js/jquery-tags/jquery.tagsinput.min.js"),

    "jquery-ui-timepicker" => array("external/js/jquery-plugin/jquery-ui-timepicker-addon.js"),

    "tiny_mce" => array("external/js/tiny_mce-3.5.8/tiny_mce.js"),

    "editablegrid" => array(
        "external/js/editablegrid-2.0.1/editablegrid-2.0.1.js",
        "external/js/editablegrid-2.0.1/editablegrid-2.0.1-extend.js"),


    "jquery-CircularContentCarousel" => array(
        "external/js/CircularContentCarousel/js/jquery-1.6.2.min.js",
        "external/js/CircularContentCarousel/js/jquery.contentcarousel.js",
        "external/js/CircularContentCarousel/js/jquery.easing.1.3.js",
        "external/js/CircularContentCarousel/js/jquery.mousewheel.js"),

    "fullcalendar-js" => array("external/js/FullCalendar-1.6.1/fullcalendar/fullcalendar.js"),

    "slickgrid" => array(
        "external/js/SlickGrid/lib/jquery-1.7.min.js",
        "external/js/SlickGrid/lib/jquery.event.drag-2.2.js",
        "external/js/SlickGrid/lib/jquery.event.drop-2.2.js",
        "external/js/SlickGrid/slick.core.js",
        "external/js/SlickGrid/slick.grid.js",
        "external/js/SlickGrid/slick.dataview.js",
        "external/js/SlickGrid/slick.formatters.js",
        //"external/js/SlickGrid/slick.editors.js",
    ),

    "jquery-tmpl" => array(
        "external/js/jquery-tmpl/jquery.tmpl.min.js"
    ),

    "rateit" => array(
        "external/js/rateit/src/jquery.rateit.min.js"
    )

);

$GLOBAL_DEPS = array(
    "shared_php" => array(
        "php" => array(
            "DatabaseUtils" => "includes/shared/utils/database_utils.php",
            "PageBuilder" => "includes/shared/utils/page_builder.php",
            "GlobalFunction" => "includes/shared/utils/global_functions.php",
            "HtmlWidgets" => "includes/shared/utils/html_widgets.php",
        )
    )
)

?>
