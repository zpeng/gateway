<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "category":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/category.php');
            break;
        case "city_list":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/city_list.php');
            break;
        case "city_update":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/city_update.php');
            break;
        case "tags":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/tags.php');
            break;

        case "supplier_list":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/supplier_list.php');
            break;
        case "supplier_update":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/supplier_update.php');
            break;

        case "client_list":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/client_list.php');
            break;

        case "template_list":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/template_list.php');
            break;
        case "template_update":
            include_once(BASE_PATH.'modules/deal_steal/admin/view/template_update.php');
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
