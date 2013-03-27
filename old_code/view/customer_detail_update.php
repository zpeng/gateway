<div class="content">
    <h5>Client Detail</h5>
    <?
    include_once 'view/msg_view.php';
    ?>

    <?
    $customer = new Customer();
    $customer = $s_cart->get_customer();

    ?>
    <div style="padding: 10px 10px 10px 10px ;">
        <form id="customerAddressUpdateForm" action='process/customer_detail_update_process.php' method='post'
              onsubmit='return checkCustomerDetailUpdateForm(this)'>
            <input name="customer_id" id="customer_id" type="hidden" value="<?=$customer->get_customer_id()?>" />

            <table width="600" border="0"  >
                <tr>
                    <td width="30%" align="right"><span class="label_title">Email: </span></td>
                    <td><input name="email" id="email" readonly="true" style="width: 250px;" value="<?=$customer->get_email()?>"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Firstname: </span></td>
                    <td><input name="firstname" id="firstname" style="width: 250px;" value="<?=$customer->get_firstname()?>"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Lastname: </span></td>
                    <td><input name="lastname" id="lastname" style="width: 250px;" value="<?=$customer->get_lastname()?>"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Telephone: </span></td>
                    <td><input name="telephone" id="telephone" style="width: 250px;" value="<?=$customer->get_telephone()?>"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Mobile: </span></td>
                    <td><input name="mobile" id="mobile" style="width: 250px;" value="<?=$customer->get_mobile()?>"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Receiving Our Newsletters: </span></td>
                    <td><?=outputNewsletterCheckbox($customer->get_newsletter(),"newsletter")?>
                    </td>
                </tr>
                <tr>
                    <td width="30%" height="20" align="right"></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="30%" align="right"></td>
                    <td><input type="submit" value="Save It !" title="Save It !" class="blue_button_style"/>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
