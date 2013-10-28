<?php

require_once('../includes/bootstrap.php');
require_once('../external/php/Eden-3.1/eden.php');



use modules\deal_steal\includes\classes\EmailTemplateManager;
use modules\deal_steal\includes\classes\Template;

$data["client_name"] = "Asif Awan";
$data["new_password"] = "ABCDEFGEEDF111";

$emailTemplateManager = new EmailTemplateManager();
$template = new Template();
$content = "";
if ($template->loadByKey("customer_password_reset")) {
    try {
        $content =  $emailTemplateManager->getProcessedContentFromTemplate($template->getContent(),$data);
    } catch (Exception $e) {
        throw new Exception("Unable to process the template due to the following error \n\n\n" . $e->getMessage() . "\n");
    }
} else {
    throw new Exception("Template " . $template_key . " is not found!");
}

eden()->setLoader(true);
$smtp = eden('mail')->smtp(SMTP_SERVER, SMTP_USER, SMTP_PASSWORD, SMTP_PORT);

$smtp->setSubject('Welcome!')
    ->setBody($content , true)
    ->addTo('aawan311@gmail.com')
    ->send();
$smtp->disconnect();

?>