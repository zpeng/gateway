<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "category":
            include_once(BASE_PATH . 'modules/deal_steal/view/category.php');
            break;

        case "order_list":
            include_once(BASE_PATH . 'modules/deal_steal/view/order_list.php');
            break;
        case "order_detail":
            include_once(BASE_PATH . 'modules/deal_steal/view/order_detail.php');
            break;

        case "city_list":
            include_once(BASE_PATH . 'modules/deal_steal/view/city_list.php');
            break;
        case "city_update":
            include_once(BASE_PATH . 'modules/deal_steal/view/city_update.php');
            break;
        case "tags":
            include_once(BASE_PATH . 'modules/deal_steal/view/tags.php');
            break;

        case "supplier_list":
            include_once(BASE_PATH . 'modules/deal_steal/view/supplier_list.php');
            break;
        case "supplier_update":
            include_once(BASE_PATH . 'modules/deal_steal/view/supplier_update.php');
            break;

        case "client_list":
            include_once(BASE_PATH . 'modules/deal_steal/view/client_list.php');
            break;
        case "client_detail":
            include_once(BASE_PATH . 'modules/deal_steal/view/client_detail.php');
            break;

        case "template_list":
            include_once(BASE_PATH . 'modules/deal_steal/view/template_list.php');
            break;
        case "template_update":
            include_once(BASE_PATH . 'modules/deal_steal/view/template_update.php');
            break;

        case "deal_list":
            include_once(BASE_PATH . 'modules/deal_steal/view/deal_list.php');
            break;
        case "deal_update":
            include_once(BASE_PATH . 'modules/deal_steal/view/deal_update.php');
            break;
        case "deal_of_the_day":
            include_once(BASE_PATH . 'modules/deal_steal/view/deal_of_the_day.php');
            break;

        case "concierge_list":
            include_once(BASE_PATH . 'modules/deal_steal/view/concierge_list.php');
            break;
        case "concierge_update":
            include_once(BASE_PATH . 'modules/deal_steal/view/concierge_update.php');
            break;

        case "config_list":
            include_once(BASE_PATH . 'modules/core/view/config_list.php');
            break;
        case "config_update":
            include_once(BASE_PATH . 'modules/core/view/config_update.php');
            break;
        default:
            include_once(BASE_PATH . 'modules/core/view/config_list.php');
            break;
    }
    ?>
</div>
