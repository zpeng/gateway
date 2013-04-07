<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "user_list":
            include_once('view/user_list.php');
            break;
        case "user_password_update":
            include_once('view/user_password_update.php');
            break;
        case "user_module_update":
            include_once('view/user_module_update.php');
            break;
        case "config_list":
            include_once('view/config_list.php');
            break;
        default:
            include_once('view/config_list.php');
            break;
    }
    ?>
</div>
