<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "user_list":
            include_once(BASE_PATH.'modules/core/view/user_list.php');
            break;
        case "user_update":
            include_once(BASE_PATH.'modules/core/view/user_update.php');
            break;
        case "user_create":
            include_once(BASE_PATH.'modules/core/view/user_create.php');
            break;
        case "config_list":
            include_once(BASE_PATH.'modules/core/view/config_list.php');
            break;
        case "config_update":
            include_once(BASE_PATH.'modules/core/view/config_update.php');
            break;
        default:
            include_once(BASE_PATH.'modules/core/view/config_list.php');
            break;
    }
    ?>
</div>
