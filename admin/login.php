<?php
require_once('../php/shared/config.php');
?>

<?= outputHTMLStartBackend("Administration Login", [] , $CSS_BACKEND_LIST); ?>

<table border="0" cellpadding="0" cellspacing="0" class="login_table">
    <tr>
        <td class="login_table_top_bar" colspan="2">
            Administration Login
        </td>
    </tr>
    <tr>
        <td width="30%" class="login_table_left_panel" valign="middle" align="center">
            <img src="images/locker.png" width="80" height="80"/>
        </td>
        <td class="login_table_right_panel">
            <form method='post' action='control/login.php'>
                <table width="300" border="0">
                    <tr>
                        <td colspan="2" height="50">
                            <?
                            include_once('view/notification_bar.php');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="100" class="login_table_label">Email:</td>
                        <td><input name="email" class="login_table_input"/></td>
                    </tr>
                    <tr>
                        <td width="100"class="login_table_label">Password:</td>
                        <td><input name="password" type="password" class="login_table_input"/></td>
                    </tr>
                    <tr>
                        <td width="100" align="right"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="100" align="right"></td>
                        <td align="right">
                            <input name='Login' type='image' value='Login' title="Login" src="images/login_btn.gif"/>
                        </td>
                    </tr>

                </table>
            </form>
        </td>
    </tr>
    <tr>
        <td class="login_table_footer" colspan="2">
            <b>&copy; 2013 Rings of Software Engineers</b>
        </td>
    </tr>
</table>
<?= outputHTMLEnd(); ?>
