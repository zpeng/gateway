<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "user_list":
            include_once('view/user_list.php');
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
