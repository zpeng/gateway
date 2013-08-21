<?php
require_once('../includes/bootstrap.php');

use modules\deal_steal\includes\classes\TemplateManager;


$data["client_name"] = "Ziyang";
$data["new_password"] = "ABCDEFGEEDF111";

$templateManager = new TemplateManager();

try {
    echo $templateManager->getProcessedContentFromTemplate("customer_password_reset",$data);
} catch (Exception $e) {
    echo $e->getMessage();
}


?>