<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "deal_category":
            include_once(BASE_PATH.'modules/core/admin/view/deal_category.php');
            break;



        case "config_list":
            include_once(BASE_PATH.'modules/core/admin/view/config_list.php');
            break;
        case "config_update":
            include_once(BASE_PATH.'modules/core/admin/view/config_update.php');
            break;
        default:
            include_once(BASE_PATH.'modules/core/admin/view/config_list.php');
            break;
    }
    ?>
</div>
