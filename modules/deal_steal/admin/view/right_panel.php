<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "deal_category":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/deal_category.php');
            break;
        case "city_list":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/city_list.php');
            break;
        case "city_update":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/city_update.php');
            break;


        case "config_list":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/config_list.php');
            break;
        case "config_update":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/config_update.php');
            break;
        default:
            include_once(BASE_PATH.'modules/deal_steal/admin/view/config_list.php');
            break;
    }
    ?>
</div>
