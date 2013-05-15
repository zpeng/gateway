<?php
$module_config = array(
    "module_name" => "Deal Steal",
    "module_logo" => "modules/deal_steal/images/ds-logo-small.png",
    "module_view_menu" => "modules/deal_steal/view/left_panel.php",
    "module_view_content" => "modules/deal_steal/view/right_panel.php",

    //customized config values
    "supplier_logo_folder" => SERVER_URL."images/suppliers/logo/",
    "deal_image_folder" => SERVER_URL."images/deals/",

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

?>