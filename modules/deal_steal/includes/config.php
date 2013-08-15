<?php
$module_config = array(
    "module_name" => "Deal Steal",
    "module_logo" => "modules/deal_steal/images/ds-logo-small.png",
    "module_view_menu" => "modules/deal_steal/view/left_panel.php",
    "module_view_content" => "modules/deal_steal/view/right_panel.php",

    //customized config values
    "supplier_logo_folder" => SERVER_URL."images/suppliers/logo/",
    "deal_image_folder" => SERVER_URL."images/deals/",

    "php" => array(
        "external/php/MPDF57/mpdf.php"
    ),

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

?>