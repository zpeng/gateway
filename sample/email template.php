<?php
require_once('../includes/bootstrap.php');

use modules\deal_steal\includes\classes\TemplateManager;
use modules\deal_steal\includes\classes\Template;

$data["client_name"] = "Ziyang";
$data["new_password"] = "ABCDEFGEEDF111";

$templateManager = new TemplateManager();
$template = new Template();

if ($template->loadByKey("customer_password_reset")) {
    try {
        echo $templateManager->getProcessedContentFromTemplate($template->getContent(),$data);
    } catch (Exception $e) {
        throw new Exception("Unable to process the template due to the following error \n\n\n" . $e->getMessage() . "\n");
    }
} else {
    throw new Exception("Template " . $template_key . " is not found!");
}


?>