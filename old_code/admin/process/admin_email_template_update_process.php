<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_email_template_update"; // target of the redirect

$email_template_id = secureRequestParameter($_REQUEST["email_template_id"]);
$email_template =    secureRequestParameter($_REQUEST["email_template"]);
$email_template_title =secureRequestParameter($_REQUEST["email_template_title"]);


$emailTemplate = new EmailTemplate();
$emailTemplate->loadByID($email_template_id);
$emailTemplate->set_email_template($email_template);
$emailTemplate->set_email_template_title($email_template_title);

$emailTemplate->update();

$url=$url."&email_template_id=".$email_template_id;
$msg = "The email template [".$email_template_title."] has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


