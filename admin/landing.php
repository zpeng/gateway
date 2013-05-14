<?php
// this is always required
require_once('../includes/bootstrap.php');
include(BASE_PATH."modules/core/includes/classes/UserSession.php");

require_once(BASE_PATH . 'admin/control/auth_landing.php');

?>

<?= outputHTMLStartBackend("Admin Control Panel", $GLOBAL_DEPS["a74ad8dfacd4f985eb3977517615ce25"]) ?>



<? include_once('view/header_bar.php') ?>

<? include_once('view/top_panel.php') ?>

    <div id="landing_panel">
        <?php
        foreach ($s_user_session->user_subscribe_module_code_name_map as $module_code => $module_name) {
            echo "<div class='module_box' ><a href='main.php?module_code=" . $module_code . "&view=default'>
            <img src='" . SERVER_URL . $GLOBAL_DEPS[$module_code]["module_logo"] . "' class='module_logo' />
            " . $module_name . "</a></div>";
        }
        ?>

    </div>
<? include_once('view/footer.php') ?>



<?= outputHTMLEnd() ?>