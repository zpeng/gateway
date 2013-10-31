<?php
use modules\cms\includes\classes\Content;

if (isset($_REQUEST["content_id"]) && !is_null($_REQUEST["content_id"])) {
    $content_id = secureRequestParameter($_REQUEST["content_id"]);
    $content = new Content();
    if (!$content->loadByID($content_id)) {
        redirect_to_404();
    }
} else {
    redirect_to_404();
}
?>
<!-- the main content -->
<div id="main">

    <!-- Left Menu -->
    <? include_once("view/left_menu.php"); ?>


    <div class="content">
        <div class="subnav">
            <span class="page_title"><?= $content->get_title() ?></span>
        </div>

        <div class="article"><?= $content->get_article() ?></div>

    </div>

    <div class="clear"></div>
</div>
<div class="clear"></div>