<?php
$module_config = array(
    "module_name" => "Deal Steal",
    "module_logo" => "modules/deal_steal/admin/images/deal-steal-logo.png",
    "module_view_menu" => "modules/deal_steal/admin/view/left_panel.php",
    "module_view_content" => "modules/deal_steal/admin/view/right_panel.php",

    "php" => array(
        "Category" => "modules/deal_steal/includes/classes/Category.php",
        "CategoryManager" => "modules/deal_steal/includes/classes/CategoryManager.php",
        "Client" => "modules/deal_steal/includes/classes/Client.php",
        "City" => "modules/deal_steal/includes/classes/City.php",
        "CityManager" => "modules/deal_steal/includes/classes/CityManager.php",
        "Deal" => "modules/deal_steal/includes/classes/Deal.php",
        "DealImage" => "modules/deal_steal/includes/classes/DealImage.php",
        "DealTagManager" => "modules/deal_steal/includes/classes/DealTagManager.php",
        "LoveHate" => "modules/deal_steal/includes/classes/LoveHate.php",
        "RatingReview" => "modules/deal_steal/includes/classes/RatingReview.php",
        "Supplier" => "modules/deal_steal/includes/classes/Supplier.php",
        "Tag" => "modules/deal_steal/includes/classes/Tag.php",
    ),

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