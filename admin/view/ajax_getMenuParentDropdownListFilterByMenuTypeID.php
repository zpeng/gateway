<?php
require_once("../../included/class_loader.php") ;


$menu_type_id = secureRequestParameter($_REQUEST["menu_type_id"]);
$menuType = new MenuType();
$menuType->load($menu_type_id);
$menuList = $menuType->getMenuItemListByMenuType();

$MenuParentdropDownField = outputMenuItemListAsDropdownList($menuList, "menu_parent_id", "250");

echo " <table width='800' border='0' style='font:100%;' cellpadding='3'  >
        <tr>
            <td width='150' align='right' ><b>Menu Parent:</b></td>
            <td align='left'>".$MenuParentdropDownField."</td>
        </tr>
</table>";


?>
