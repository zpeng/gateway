<?php
// this is always required
require_once('../includes/bootstrap.php');

require_once(BASE_PATH . 'admin/control/auth_landing.php');
?>

<?= outputHTMLStartBackend("Admin Control Panel", $GLOBAL_DEPS["a74ad8dfacd4f985eb3977517615ce25"]) ?>



<? include_once('view/header_bar.php') ?>

<? include_once('view/top_panel.php') ?>

    <div id="landing_panel">
        <?php
        $count = 0;
        foreach ($s_user_session->userModuleAccessNameList as $module_name) {
            $module_code = $s_user_session->userModuleAccessCodeList[$count];
            echo "<div class='module_box' ><a href='main.php?module_code=" . $module_code . "&view=default'>
            <img src='".SERVER_URL . $GLOBAL_DEPS[$module_code]["module_logo"]."' class='module_logo' />
            " . $module_name . "</a></div>";
            $count++;
        }
        ?>

    </div>
<? include_once('view/footer.php') ?>



<?= outputHTMLEnd() ?>