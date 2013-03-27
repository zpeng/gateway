<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gemini Eshop - Administration Login</title>
        <link rel="stylesheet" type="text/css" href="css/admin_login.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <?
        include_once 'view/admin_msg_view.php';
        ?>
        <center>
            <table  width="500" border="0" cellpadding="0" cellspacing="0"  class="login_table">
                <tr>
                    <td class="login_top_bar" colspan="2">
                        <b style="color:white">Gemini Eshop - Administration Login</b>
                    </td>
                </tr>
                <tr >
                    <td width="30%"class="login_left_panel" valign="middle" align="center">
                        <img src="images/admin_login/lock.png" width="80" height="80" />
                    </td>
                    <td class="login_right_panel">
                        <br/><br/>

                        <form method='post' action='process/admin_login_process.php' >
                            <table width="250" style="font-size:100%" border="0">
                                <tr>
                                    <td colspan="2">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100" align="right"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="100" align="right"><b>Email:</b>&nbsp;</td>
                                    <td><input name="email" style="width: 150px;" /></td>
                                </tr>
                                <tr>
                                    <td width="100" align="right"><b>Password:</b>&nbsp;</td>
                                    <td><input name="password" type="password" style="width: 150px;" /></td>
                                </tr>
                                <tr>
                                    <td width="100" align="right"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="100" align="right"></td>
                                    <td align="right">
                                        <input name='Login' type='image' value='Login'
                                               title="Login" src="images/admin_login/b_login.gif"/>
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </td>
                </tr>
                <tr >
                    <td class="login_footer" colspan="2">
                        <b>&copy; 2009 Rings of Software Engineers</b>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>