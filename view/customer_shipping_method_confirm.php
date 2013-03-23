<div class="content">
    <h5>Shipping Methods</h5>

    <?


    $customer = new Customer();
    $customer = $s_cart->get_customer();

    $billing_address = new Address();
    $billing_address = $customer->load_billing_address();

    $delivery_address = new Address();
    $delivery_address = $customer->load_delivery_address();
    ?>
    <div style="padding: 10px 10px 10px 10px ;">
        <form id="customerShippingConfirmForm" action='process/customer_order_confirm_process.php' method='post'
              onsubmit='return checkCustomerShippingConfirmForm(this)'>
            <input name="customer_id" id="customer_id" type="hidden" value="<?= $customer->get_customer_id() ?>" />
            <table width="400" border="0"
                   style="margin-left: 10px">
                <tr>
                    <td  height="20" align="left">
                        <b>Choose Your Shipping Method:</b>
                    </td>
                </tr>
                <tr>
                    <td height="20" align="left">
<?
    echo outputShippingMethodRadioButtonsGroupTable($s_configManager);
?>
                    </td>
                </tr> 
                <tr>
                    <td  height="30" align="left">
                    </td>
                </tr>

                <!--
                <tr>
                    <td  height="20" align="left">
                        <b>Shipping Address Confirm:</b>
                    </td>
                </tr>                
                <tr>
                    <td>
                        <table width="500" border="0"  >
                            <tr>
                                <td align="right" width="150"><span class="label_title">Recipients:</span></td>
                                <td>
                                    <input name="d_recipients" id="d_recipients" style="width: 300px;"  value="<?= $delivery_address->get_recipients() ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Street:</span></td>
                                <td>
                                    <input name="d_street" id="d_street" style="width: 300px;"  value="<?= $delivery_address->get_street() ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">City:</span></td>
                                <td>
                                    <input name="d_city" id="d_city" style="width: 300px;"  value="<?= $delivery_address->get_city() ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Postcode:</span></td>
                                <td><input name="d_postcode" id="d_postcode" style="width: 300px;"    value="<?= $delivery_address->get_postcode() ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">State/Province:</span></td>
                                <td>
                                    <input name="d_state" id="d_state" style="width: 300px;"    value="<?= $delivery_address->get_state() ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Country:</span></td>
                                <td>
                                    <input name="d_country" id="d_country" style="width: 300px;"  value="<?= $delivery_address->get_country() ?>"/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                -->

                <tr>
                    <td height="20">
                    </td>
                </tr>
                <tr>
                    <td  align="center">
                        <input type="submit" value="Confirm Your Order" title="Confirm Your Order" class="blue_button_style"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

