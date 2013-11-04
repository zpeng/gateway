<?php

require_once('../includes/bootstrap.php');
require_once('../external/php/Eden-3.1/eden.php');

use modules\deal_steal\includes\classes\Client;
use modules\deal_steal\includes\classes\ClientManager;
use modules\deal_steal\includes\classes\EmailTemplateManager;
use modules\deal_steal\includes\classes\Template;


$email = secureRequestParameter($_REQUEST['email']);


$clientManager = new ClientManager();

if (!$clientManager->checkClientExistsByEmail($email)) {
    // the email exits
    header("Location: " . SERVER_URL . "index.php?view=password_retrieve&error=Sorry, we can't find any record related to this email.");

} else {

    $client = new Client();
    $client->loadByEmail($email);
    $new_password = substr(sha1("DEALSTEAL".time()), 0, 8);
    $client->updatePassword($new_password);

    // now to notify user by email
    $data["client_name"] = $client->getFullName();
    $data["new_password"] = $new_password;

    $emailTemplateManager = new EmailTemplateManager();
    $template = new Template();
    $content = "";
    if ($template->loadByKey("customer_password_reset")) {
        try {
            $content = $emailTemplateManager->getProcessedContentFromTemplate($template->getContent(), $data);
        } catch (Exception $e) {
            throw new Exception("Unable to process the template due to the following error \n\n\n" . $e->getMessage() . "\n");
        }
    } else {
        throw new Exception("Template " . $template_key . " is not found!");
    }


    eden()->setLoader(true);
    $smtp = eden('mail')->smtp(SMTP_SERVER, SMTP_USER, SMTP_PASSWORD, SMTP_PORT);

    $smtp->setSubject('Your New Password for DealSteal!')
        ->setBody($content , true)
        ->addTo($client->getClientEmail())
        ->send();
    $smtp->disconnect();

    header("Location: " . SERVER_URL . "index.php?view=password_retrieve&info=Your new password is sending to your email account " . $email);
}
?>