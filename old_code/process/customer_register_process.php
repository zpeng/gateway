<?php

require_once('../included/class_loader.php');

$_reg_email = secureRequestParameter($_REQUEST["reg_email"]);
$_reg_password = secureRequestParameter($_REQUEST["reg_password"]);

$customerManager = new CustomerManager();
$result = $customerManager->checkCustomerEmailExist($_reg_email);

if ($result) {
    // the email already exists
    header("Location: ../index.php?view=customer_register&error=The email addresss already exists!");
} else {

    // check is fine, proceed
    $customer = new Customer();
    $customer->set_email($_reg_email);
    $customer->set_password(md5($_reg_password));


    $customer->set_firstname(secureRequestParameter($_REQUEST["firstname"]));
    $customer->set_lastname(secureRequestParameter($_REQUEST["lastname"]));


    if (secureRequestParameter($_REQUEST["newsletter"]) == "on") {
        $customer->set_newsletter("Y");
    } else {
        $customer->set_newsletter("N");
    }

    $customer->set_mobile(secureRequestParameter($_REQUEST["mobile"]));
    $customer->set_telephone(secureRequestParameter($_REQUEST["telephone"]));

    //create the new customer
    $customer_id = $customer->insert();


    //load this new customer
    $customer = new Customer();
    $customer->loadById($customer_id);

    //send a notification email to the new customer
    $emailTemplateManager = new EmailTemplateManager();
    $email_obj = new Email();
    $email_obj = $emailTemplateManager->generateCustomerRegisterSucceedEmail($customer);


    $emailSender = new EmailSender();
    $emailSender->smtp_mail($email_obj->get_recipient(), $email_obj->get_subject(), $email_obj->get_message());

// to start a session if there is none
    if (session_id() == "") {
        session_start();
    }


    // get Cart
    if (!isset($_SESSION['cart'])) {
        //create a new cart in session
        $s_cart = new Cart();
        $order = new Order();
        $order->set_customer_id($customer->get_customer_id());
        $s_cart->set_order($order);
        $s_cart->set_customer_login(true);
        $s_cart->set_customer_id($customer->get_customer_id());
        $s_cart->set_customer($customer);

        unset($_SESSION['cart']);
        $_SESSION['cart'] = serialize($cart);

        header("Location: ../index.php?view=customer_order_history&info=Thank you for registering with us!");
    } else {
        //reload cart from session
        $str = unserialize($_SESSION['cart']);
        $s_cart = Cart::cast($str);

//        $order = new Order();
//        $s_cart->set_order($order);
//        $s_cart->set_customer_login(true);
//        $s_cart->set_customer_id($customer->get_customer_id());
//        $s_cart->set_customer($customer);

        $s_cart->set_customer($customer);
        $s_cart->set_customer_id($customer->get_customer_id());
        $s_cart->set_customer_login(true);

        unset($_SESSION['cart']);
        $_SESSION['cart'] = serialize($s_cart);

        header("Location: ../index.php?view=shopping_cart&info=Thank you for registering with us!");
    }
}
?>
