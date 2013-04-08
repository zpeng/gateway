<div id="right_panel">
    <?php
    switch (secureRequestParameter($_REQUEST["view"])) {
        case "article_list":
            include_once(BASE_PATH.'modules/cms/admin/view/article_list.php');
            break;
        default:
            include_once(BASE_PATH.'modules/cms/admin/view/article_list.php');
            break;
    }
    ?>
</div>