<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_content_list"; // target of the redirect

$content_id = secureRequestParameter($_REQUEST["content_id"]);

$content = new Content();
$content->load($content_id);
$content->delete();


$msg = "The content has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


