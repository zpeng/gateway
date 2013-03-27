<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_content_list"; // target of the redirect


session_start();
$user_id = $_SESSION['admin_id'];


$content = new Content();


//set author
$admin = new Administrator();
$admin->loadByID($user_id);
$content->set_author($admin);
$content->set_author_id($user_id);



$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();


$contentDescriptionList;
if (sizeof($languageList) > 0) {
    $language = new Language();
    $count=0;
    foreach($languageList as $language) {
        $title = secureRequestParameter($_REQUEST["title".$language->get_language_id()]);
        $abstract = secureRequestParameter($_REQUEST["abstract".$language->get_language_id()]);
        $article = secureRequestParameter($_REQUEST["article".$language->get_language_id()]);

        $contentDescription = new ContentDescription();
        $contentDescription->set_language($language);
        $contentDescription->set_language_id($language->get_language_id());
        $contentDescription->set_title($title);
        $contentDescription->set_abstract($abstract);
        $contentDescription->set_article($article);
        $contentDescription->set_last_modify_by($admin);
        $contentDescription->set_last_modify_by_user_id($admin->get_admin_id());

        $contentDescriptionList[$count] = $contentDescription;
        $count++;
    }
}
$content->set_content_description_list($contentDescriptionList);

$content->insert();

$msg = "The new content has been published.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


