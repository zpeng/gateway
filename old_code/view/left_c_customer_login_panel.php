<div class="left_box">
    <h6>Login Form</h6>
    <table style="width:200px;margin-left: 20px;margin-top: 5px;" border="0">
        <form action="process/customer_login_process.php" method='post' >
            <tr>
                <td>Email:</td>
            </tr>
            <tr>
                <td><input name="email" id="email" style="width: 200px;" /></td>
            </tr>
            <tr>
                <td>Password:</td>
            </tr>
            <tr>
                <td><input name="password" id="password" type="password" style="width: 200px;" /></td>
            </tr>
            <tr>
                <td><input type="submit" value="Login" title="Login" class="blue_button_style"/></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td><a href="index.php?view=customer_retrieve_password">Forgot your password?</a></td>
            </tr>
            <tr>
                <td><a href="index.php?view=customer_register">Create an account.</a></td>
            </tr>
        </form>
    </table>

</div>