<div class="content">
    <h5>Client Address</h5>
    <?
    include_once 'view/msg_view.php';
    ?>

    <?
    $customer = new Customer();
    $customer = $s_cart->get_customer();

    $billing_address = new Address();
    $billing_address = $customer->load_billing_address();

    $delivery_address = new Address();
    $delivery_address = $customer->load_delivery_address();
    ?>
    <div style="padding: 10px 10px 10px 10px ;">
        <form id="customerAddressUpdateForm" action='process/customer_address_update_process.php' method='post'
              onsubmit='return checkCustomerAddressUpdateForm(this)'>
            <input name="customer_id" id="customer_id" type="hidden" value="<?=$customer->get_customer_id()?>" />
            <table width="680" border="0" >
                <tr>
                    <td>
                        <table width="300" border="0"  >
                            <tr>
                                <td align="center" colspan="2"><span class="label_title">Billing Address</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" width="100"><span class="label_title">Recipients:</span></td>
                                <td>
                                    <input name="b_recipients" id="b_recipients" style="width: 200px;"  value="<?=$billing_address->get_recipients()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Street:</span></td>
                                <td>
                                    <input name="b_street" id="b_street" style="width: 200px;"  value="<?=$billing_address->get_street()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">City:</span></td>
                                <td>
                                    <input name="b_city" id="b_city" style="width: 200px;"  value="<?=$billing_address->get_city()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Postcode:</span></td>
                                <td><input name="b_postcode" id="b_postcode" style="width: 200px;"    value="<?=$billing_address->get_postcode()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">State/Province:</span></td>
                                <td>
                                    <input name="b_state" id="b_state" style="width: 200px;"    value="<?=$billing_address->get_state()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Country:</span></td>
                                <td>
                                    <input name="b_country" id="b_country" style="width: 200px;"  value="<?=$billing_address->get_country()?>"/>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="100"></td>
                    <td>
                        <table width="300" border="0"  >
                            <tr>
                                <td align="center" colspan="2"><span class="label_title">Delivery Address</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" width="100"><span class="label_title">Recipients:</span></td>
                                <td>
                                    <input name="d_recipients" id="d_recipients" style="width: 200px;"  value="<?=$delivery_address->get_recipients()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Street:</span></td>
                                <td>
                                    <input name="d_street" id="d_street" style="width: 200px;"  value="<?=$delivery_address->get_street()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">City:</span></td>
                                <td>
                                    <input name="d_city" id="d_city" style="width: 200px;"  value="<?=$delivery_address->get_city()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Postcode:</span></td>
                                <td><input name="d_postcode" id="d_postcode" style="width: 200px;"    value="<?=$delivery_address->get_postcode()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">State/Province:</span></td>
                                <td>
                                    <input name="d_state" id="d_state" style="width: 200px;"    value="<?=$delivery_address->get_state()?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" ><span class="label_title">Country:</span></td>
                                <td>
                                    <input name="d_country" id="d_country" style="width: 200px;"  value="<?=$delivery_address->get_country()?>"/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">
                        <input type="submit" value="Save It !" title="Save It !" class="blue_button_style"/>
                    </td>
                    <td></td>
                </tr>
            </table>
        </form>

    </div>
</div>
