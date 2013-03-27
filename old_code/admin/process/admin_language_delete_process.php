<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_language_list"; // target of the redirect

$_language_id = secureRequestParameter($_REQUEST["language_id"]);

$language = new Language();
$language->load($_language_id);
$language->delete();


$msg = "The language [".$language->get_language_name()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


