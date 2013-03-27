<div class="header">
    <table width="100%" border="0" class="header">
        <tr>
            <td width="150" height="60">
                <a href="index.php"><img src="images/site/logo.png" width="300" alt="Light Zone" border="0" /></a>
            </td>

            <td>
            </td>

            <td width="300" >
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="right" valign="middle" height="30" colspan="2">
                            <img src="images/site/social_network.png" />
                            <? // choose language
                               echo outputLanguageOtpionURL($_SERVER['PHP_SELF'],$_SERVER['QUERY_STRING']);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" height="30" valign="middle" colspan="2" >
                            <span class="label_title">
                                <?

                                if ($s_cart->get_customer_login()) {
                                    echo "Hello, ".$s_cart->get_customer()->get_full_name()."! (<a href='process/customer_logout_process.php'>Logout?</a>)";
                                }else {
                                    echo "<a href='index.php?view=customer_login'>Login</a>&nbsp;&nbsp;";
                                    echo "<a href='index.php?view=customer_register'>Register</a>";
                                }
                                ?>
                            </span>

                            <a href="index.php?view=shopping_cart"><img src="images/site/cart-bg.gif" border="0" />
                                <?
                                $order = new Order();
                                $order = $s_cart->get_order();
                                echo $order->getTotalOrderQuantity()
                                ?> items</a>
                        </td>
                    </tr>
                    <tr valign="middle">
                    <form action="index.php" style="height:20px; margin:0">
                        <td align="right" height="30" valign="middle">
                            <input type='hidden' name="view" value="product_search" />
                            <input name="key" type="text" style="width:170px; height:20px;"/>
                        </td>
                        <td align="right" height="30" width="45" valign="middle">
                            <input type="submit" value="Search" title="Search" class="blue_button_style" />
                        </td>
                    </form>
        </tr>
    </table>

</td>
</tr>
</table>
</div>