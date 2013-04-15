<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "user_list":
            include_once(BASE_PATH.'modules/core/admin/view/user_list.php');
            break;
        case "user_password_update":
            include_once(BASE_PATH.'modules/core/admin/view/user_password_update.php');
            break;
        case "user_module_update":
            include_once(BASE_PATH.'modules/core/admin/view/user_module_update.php');
            break;
        case "user_create":
            include_once(BASE_PATH.'modules/core/admin/view/user_create.php');
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
