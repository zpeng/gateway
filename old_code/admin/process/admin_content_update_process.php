<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_content_update"; // target of the redirect


session_start();
$user_id = $_SESSION['admin_id'];


$content_id = secureRequestParameter($_REQUEST["content_id"]);

$content = new Content();
$content->load($content_id);

//set author
$author = new Administrator();
$author->loadByID($user_id);
$content->set_author($author);
$content->set_author_id($user_id);

$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();

$contentDescList = null;

if (sizeof($languageList) > 0) {
    $language = new Language();
    $count=0;
    foreach($languageList as $language) {
        $contentDescription = new ContentDescription();
        $contentDescription = $content->loadContentDescriptionByLanguageID($language->get_language_id());

        if ($contentDescription != null) {

            $title = secureRequestParameter($_REQUEST["title".$language->get_language_id()]);
            $abstract = secureRequestParameter($_REQUEST["abstract".$language->get_language_id()]);
            $article = $_REQUEST["article".$language->get_language_id()];
            $contentDescription->set_title($title);
            $contentDescription->set_abstract($abstract);
            $contentDescription->set_article($article);
            $contentDescription->set_last_modify_by($author);
            $contentDescription->set_last_modify_by_user_id($author->get_admin_id());
        }else {
            $contentDescription = new ContentDescription();
            
            $title = secureRequestParameter($_REQUEST["title".$language->get_language_id()]);
            $abstract = secureRequestParameter($_REQUEST["abstract".$language->get_language_id()]);
            $article = $_REQUEST["article".$language->get_language_id()];
            $contentDescription->set_content_description_id($contentDescID);
            $contentDescription->set_title($title);
            $contentDescription->set_abstract($abstract);
            $contentDescription->set_article($article);
            $contentDescription->set_last_modify_by($author);
            $contentDescription->set_last_modify_by_user_id($author->get_admin_id());
            $contentDescription->set_language_id($language->get_language_id());
            $contentDescription->set_language($language);
        }
        $contentDescList[$count] = $contentDescription;
        $count++;
    }
}

$content->set_content_description_list($contentDescList);

$content->update();

$msg = "The content has been updated.";
$url=$url."&info=".$msg."&content_id=".$content_id;
header( "Location: ".$url );



?>


