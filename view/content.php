<?

    $content_id = $_REQUEST["content_id"];
    $content = new Content();
    $content->load($content_id);
    $contentDescription = new ContentDescription();

    $contentDescription = $content->loadContentDescriptionByLanguageID($s_language_id);
    if ($contentDescription == null) {
        $contentDescription = $content->get_first_content_description();
    }



?>
<div class="content">
    <h5><?=$contentDescription->get_title()?></h5>
    <div style="padding: 10px 20px 10px 20px ;">
        <?=$contentDescription->get_article()?>
    </div>
</div>

