<?php
// this is always required
require_once('includes/bootstrap.php');
use modules\core\includes\classes\ConfigurationManager;

$configManager = new ConfigurationManager();
echo  outputHTMLStartFrontend($JS_GLOBAL, array("css/style.css"), $configManager) ?>

<div id="wapper">
<? include_once('view/top_header.php') ?>

<div id="main_body">
    <div id="main_content">
        <? include_once('view/brands_slider.php') ?>

        <div id="left_content">


            <? include_once('view/deal_of_the_day.php') ?>

            <? include_once('view/deal_list.php') ?>
        </div>

        <div id="right_content">
            <? include_once('view/supplier_thumbnail_list.php') ?>
        </div>
    </div>
</div>
<? include_once('view/footer.php') ?>
</div>

<?= outputHTMLEnd() ?>