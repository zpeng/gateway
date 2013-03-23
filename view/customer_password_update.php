<div class="content">
    <h5>Client Password</h5>
    <?
    include_once 'view/msg_view.php';
    ?>

    <?
    $customer = new Customer();
    $customer = $s_cart->get_customer();
    ?>
    <div style="padding: 10px 10px 10px 10px ;">
        <form id="customerAddressUpdateForm" action='process/customer_password_update_process.php' method='post'
              onsubmit='return checkCustomerPasswordUpdateForm(this)'>
            <input name="customer_id" id="customer_id" type="hidden" value="<?=$customer->get_customer_id()?>" />

            <table width="600" border="0"  >
                <tr>
                    <td width="30%" align="right"><span class="label_title">Email: </span></td>
                    <td><input name="email" id="email" readonly="true" style="width: 250px;" value="<?=$customer->get_email()?>"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Password: </span></td>
                    <td><input name="password" id="password" type="password" style="width: 250px;"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Password Confirm: </span></td>
                    <td><input name="password_confirm" id="password_confirm" type="password" style="width: 250px;"/>
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
