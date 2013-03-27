<?php

require_once('../included/class_loader.php') ;
require_once('../included/common_functions.php');

$_email_address = secureRequestParameter($_REQUEST["p_r_email"]);

$customerManager = new CustomerManager();
$result = $customerManager-> checkCustomerEmailExist($_email_address);

if (!$result) {
    // the email doesn't exists
    $msg = "The client who associated with this email account ".$_email_address." does not exist in our database.";
    header( "Location: ../index.php?view=customer_retrieve_password&error=".$msg );

}else {

    // check is fine, get the client
    $customer = new Customer();
    $customer->loadByEmail($_email_address);

    // generate the new password
    $newPassword = generateCustomerPassword();

    // update the new password
    $customer->set_password(md5($newPassword));
    $customer->updateCustomerPassword();


    // send client an email with the new password
    $emailTemplateManager = new EmailTemplateManager();
    $email_obj = new Email();
    $email_obj =  $emailTemplateManager->generateCustomerPasswordResetEmail($customer,$newPassword);


    $emailSender = new EmailSender();
    $emailSender->smtp_mail($email_obj->get_recipient(), $email_obj->get_subject(), $email_obj->get_message() );



    $msg = "Your password has been reset. The new password has been sent to following email address ".$_email_address;
    header( "Location: ../index.php?view=customer_retrieve_password&info=".$msg );
}

?>
