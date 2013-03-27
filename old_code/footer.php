<div class="footer">
    <table width="100%" border="0" >
        <tr align="center">
            <td valign="top" width="250">
                <img src="images/site/Paypal-and-google.gif" width="250">
            </td>
            <td>
                <table width="100%" border="0" >
                    <tr align="center">
                        <td >
                            <?
                            //get the Button Menu part of the menu
                            $menuType = new MenuType();
                            $menuType->load(2);
                            $menuList = $menuType->getMenuItemListByMenuType();


                            if (sizeof($menuList) > 0 ) {
                                foreach($menuList as $menu) {
                                    $menuDesc = new MenuDescription();
                                    $menuDesc = $menu->loadMenuDescriptionByLanguageID($_language_id);
                                    if($menuDesc == null) {
                                        $menuDesc = $menu->getDefaultMenuDescription();
                                    }
                                    echo "&nbsp;&nbsp;<a class='footer_menu' href='".$menu->get_menu_link()."'>".$menuDesc->get_menu_name()."</a>&nbsp;&nbsp;|";
                                }
                            }
                            ?>

                        </td>
                    </tr>
                    <tr align="center">
                        <td height="10">
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            <span class="copyright"> Copyright © 2013 CheapShop.com. All Rights Reserved </span>
                            <br/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
