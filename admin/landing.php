<?php
// this is always required
require_once('../includes/bootstrap.php');

require_once(BASE_PATH .'admin/control/auth_landing.php');
?>

<?= outputHTMLStartBackend("Admin Control Panel", $JS_BACKEND_LIST, $CSS_BACKEND_LIST); ?>

    <div class='content'>

        <? include_once('view/header_bar.php') ?>

        <? include_once('view/top_panel.php') ?>

        <div id="landing_panel">
            <?php
            $count =0;
            foreach($s_user_session->userModuleAccessNameList as $module_name){
                echo "<div class='module_box' ><a href='index.php?module_code=".$s_user_session->userModuleAccessCodeList[$count]."'>".$module_name."</a></div>";
                $count++;
            }
            ?>

        </div>
        <? include_once('view/footer.php') ?>
    </div>


<?= outputHTMLEnd(); ?>