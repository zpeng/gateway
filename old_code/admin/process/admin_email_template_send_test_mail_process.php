<?php

require_once('../../included/class_loader.php');

$url = "../index.php?view=admin_email_template_update"; // target of the redirect

$email_template_id = secureRequestParameter($_REQUEST["email_template_id"]);

$configManager = new ConfigurationManager();

$emailTemplate = new EmailTemplate();
$emailTemplate->loadByID($email_template_id);


$emailTemplateManager = new EmailTemplateManager();
$email_obj = new Email();

//generate test email
switch ($emailTemplate->get_email_template_key()) {
    case "register_succeed" :
    //load a test customer
        $customer = new Customer();
        $customer->loadById(1);
        $email_obj =  $emailTemplateManager->generateCustomerRegisterSucceedEmail($customer);
        break;
    case "customer_password_reset" :
    //load a test customer
        $customer = new Customer();
        $customer->loadById(1);
        //assign a new password
        $newPassword = "12345678";
        $email_obj =  $emailTemplateManager->generateCustomerPasswordResetEmail($customer,$newPassword);
        break;
    case "payment_successful":
    // send client an email when payment successful

        $order = new Order();
        $order->loadByID(1);
        $customer = new Customer();
        $customer->loadById(1);
        $email_obj = new Email();
        $email_obj =  $emailTemplateManager->generateCustomerPaymentSucceedEmail($customer,$order);        
        break;
}

// tell the user this is a testing email
$email_obj->set_subject($email_obj->get_subject()." (Test email)");

// instead of sending the email to the real client, send the email to the admin email box
$email_obj->set_recipient($configManager->getValueByKey("admin_email"));


//now let's send out the email
$emailSender = new EmailSender();
$emailSender->smtp_mail($email_obj->get_recipient(), $email_obj->get_subject(), $email_obj->get_message() );



$url=$url."&email_template_id=".$email_template_id;
$msg = "The testing email has been sent to ".$email_obj->get_recipient().".";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


