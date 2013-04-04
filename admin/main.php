<?php
// this is always required
require_once('../includes/bootstrap.php');

require_once(BASE_PATH . 'admin/control/auth.php');
?>

<?= outputHTMLStartBackend("Admin Control Panel", $GLOBAL_DEPS[$_REQUEST['module_code']]["js_backend_list"], $GLOBAL_DEPS[$_REQUEST['module_code']]["css_backend_list"]) ?>


<? include_once('view/header_bar.php') ?>

<? include_once('view/top_panel.php') ?>


    <div id='main_content'>
        <?
        // load the left menu
        include_once(BASE_PATH . $GLOBAL_DEPS[$_REQUEST['module_code']]["module_view_menu"]);

        // load the content
        include_once(BASE_PATH . $GLOBAL_DEPS[$_REQUEST['module_code']]["module_view_content"]);
        ?>

        <br class="clear"/>
    </div>

<? include_once('view/footer.php') ?>


<?= outputHTMLEnd() ?>