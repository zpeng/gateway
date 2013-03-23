<div class="content">
    <h5>Order Complete</h5>
    <div style="padding: 10px 10px 10px 10px ;">
        <?
        $result = secureRequestParameter($_REQUEST["result"]);
        $order_code = secureRequestParameter($_REQUEST["order_code"]);

        switch ($result) {
            case "success" :
                echo "Thank you for your payment. <br /> <br />
                        Your transaction has been completed,
                      and a receipt for your purchase has been emailed to you.";

                // send client an email when payment successful
                $emailTemplateManager = new EmailTemplateManager();
                $order = new Order();
                $order->loadByCode($order_code);
                $customer = new Customer();
                $customer->loadById($s_cart->get_customer_id());
                $email_obj = new Email();
                $email_obj =  $emailTemplateManager->generateCustomerPaymentSucceedEmail($customer,$order);

                $emailSender = new EmailSender();
                $emailSender->smtp_mail($email_obj->get_recipient(), $email_obj->get_subject(), $email_obj->get_message() );

                break;
            case "failed":
                echo "Sorry. There are some errors occurred in your transaction.
                          Your transaction has been cancelled.";
                break;
            case "cancel":
                echo "You have cancelled your payment and order.";
                break;
        }


        ?>
    </div>
</div>
