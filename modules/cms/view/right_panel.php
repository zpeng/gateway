<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "config_list":
            include_once(BASE_PATH.'modules/cms/view/config_list.php');
            break;
        case "config_update":
            include_once(BASE_PATH.'modules/cms/view/config_update.php');
            break;
        case "content_list":
            include_once(BASE_PATH.'modules/cms/view/content_list.php');
            break;
        case "content_create":
            include_once(BASE_PATH.'modules/cms/view/content_create.php');
            break;
        case "content_update":
            include_once(BASE_PATH.'modules/cms/view/content_update.php');
            break;
        case "menu_list":
            include_once(BASE_PATH.'modules/cms/view/menu_list.php');
            break;
        case "menu_update":
            include_once(BASE_PATH.'modules/cms/view/menu_update.php');
            break;
        case "menu_create":
            include_once(BASE_PATH.'modules/cms/view/menu_create.php');
            break;
        default:
            include_once(BASE_PATH.'modules/cms/view/content_list.php');
            break;
    }
    ?>
</div>