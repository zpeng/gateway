<?php
// this is always required
require_once('../includes/bootstrap.php');

require_once(BASE_PATH .'admin/control/auth.php');
?>

<?= outputHTMLStartBackend("admin cp", $JS_BACKEND_LIST, $CSS_BACKEND_LIST); ?>

<div class='content'>

    <? include_once('view/top_header_bar.php') ?>

    <? include_once('view/top_menu.php') ?>

</div>


<?= outputHTMLEnd(); ?>