<div class="content">
    <h5>Client Registration</h5>
    <br/>
    <center>
        <br/>
        <?
        include_once 'view/msg_view.php';
        ?>
        <br/>
        <form action="process/customer_register_process.php" method='post'
              onsubmit='return checkCustomerRegisterForm(this)'>
            <table width="680" border="0"  >
                <tr>
                    <td width="30%" align="right"><span class="label_title">Email: </span></td>
                    <td><input name="reg_email" id="reg_email" style="width: 250px;"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Password: </span></td>
                    <td><input name="reg_password" id="reg_password" type="password" style="width: 250px;"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Password Confirm: </span></td>
                    <td><input name="reg_password_confirm" id="reg_password_confirm" type="password" style="width: 250px;"/>
                    </td>
                </tr>
                <tr>
                    <td align="right" height="10"></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Firstname: </span></td>
                    <td><input name="firstname" id="firstname" style="width: 250px;"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Lastname: </span></td>
                    <td><input name="lastname" id="lastname" style="width: 250px;"/>
                    </td>
                </tr>
                <tr>
                    <td align="right" height="10"></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Telephone: </span></td>
                    <td><input name="telephone" id="telephone" style="width: 250px;"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Mobile: </span></td>
                    <td><input name="mobile" id="mobile" style="width: 250px;"/>
                    </td>
                </tr>
                <tr>
                    <td width="30%" align="right"><span class="label_title">Receiving Our Newsletters: </span></td>
                    <td><input type="checkbox" name="newsletter"  checked="true">
                    </td>
                </tr>
                <tr>
                    <td align="right" height="10"></td>
                    <td></td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td><input type="submit" value="Submit" title="Submit" class="blue_button_style"/></td>
                </tr>

            </table>
        </form>
        <br />
    </center>
</div>

