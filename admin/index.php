<?php
// this is always required
require_once('../includes/bootstrap.php');

require_once(BASE_PATH .'admin/control/auth.php');
?>

<?= outputHTMLStartBackend("Admin Control Panel", $JS_BACKEND_LIST, $CSS_BACKEND_LIST); ?>

<div id='main_content'>

    <? include_once('view/header_bar.php') ?>

    <? include_once('view/top_panel.php') ?>

    <? include_once('view/left_panel.php') ?>

    <? include_once('view/right_panel.php') ?>
    <br class="clear" />
</div>
<? include_once('view/footer.php') ?>


<?= outputHTMLEnd(); ?>