<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_language_list"; // target of the redirect

$_language_default_id =secureRequestParameter($_REQUEST["language_default_id"]);

$languageDefault = new LanguageDefault();
$languageDefault->load($_language_default_id);


$languageDefault->insertToLanguageTable($_language_default_id);

$msg = "The new language [".$languageDefault->get_language_default_name()."] has been created.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


