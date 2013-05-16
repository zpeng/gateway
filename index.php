<?php
// this is always required
require_once('includes/bootstrap.php');
use modules\core\includes\classes\ConfigurationManager;

$configManager = new ConfigurationManager();
echo  outputHTMLStartFrontend($JS_GLOBAL, array("css/style.css"), $configManager) ?>

<? include_once('view/top_header.php') ?>


    <div id="main_body">
        <div id="main_content">
            <div id="left_content">
            </div>

            <div id="right_content">

            </div>
        </div>
    </div>


<? include_once('view/footer.php') ?>
<?= outputHTMLEnd() ?>