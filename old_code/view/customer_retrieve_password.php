<div class="content">
    <h5>Customer Retrieve Password</h5>
    <br/>
    <center>
        <br/>
        <?
        include_once 'view/msg_view.php';
        ?>
        <br/>
        <table width="600" border="0" style="margin-left: 50px">
            <form action="process/customer_retrieve_password_process.php" method='post'
                  onsubmit='return checkCustomerRetrievePasswordForm(this)'>
                <tr>
                    <td align="right" width="100"><span class="label_title">Your Email:</span></td>
                    <td><input name="p_r_email" id="p_r_email" style="width: 200px;" /></td>
                </tr>
                <tr >
                    <td height="10"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Login" title="Login" class="blue_button_style"/></td>
                </tr>
            </form>
        </table>

        <br />
    </center>
</div>




