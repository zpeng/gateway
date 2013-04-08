<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of MenuManager
 *
 * @author ziyang
 */
class MenuManager
{
    //put your code here
    public function getMenuTypeList()
    {
        $menuTypelist = [];
        $count = 0;

        $link = getConnection();

        $query = "    SELECT menu_type_id         ,
                       menu_type_name       ,
                       menu_type_description,
                       menu_type_archived
                FROM   cms_menu_type
                WHERE  menu_type_archived = 'N'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $menuType = new MenuType();
            $menuType->set_menu_type_id($newArray['menu_type_id']);
            $menuType->set_menu_type_name($newArray['menu_type_name']);
            $menuType->set_menu_type_description($newArray['menu_type_description']);
            $menuType->set_menu_type_archived($newArray['menu_type_archived']);

            $menuTypelist[$count] = $menuType;
            $count++;
        }
        return $menuTypelist;
    }

    public function getMenuItemListByMenuTypeId($menu_type_id)
    {
        $menuItemlist = [];
        $count = 0;
        $link = getConnection();

        $query=" SELECT   menu_id,
                          menu_parent_id,
                          menu_type_id,
                          menu_order,
                          menu_link,
                          menu_name,
                          menu_desc,
                          menu_archived
                FROM   cms_menu
                WHERE  menu_archived = 'N'
                AND    menu_parent_id = 0
                AND    menu_type_id = " . $menu_type_id . "
                ORDER BY menu_order";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $menu = new Menu();
            $menu->set_menu_id($newArray['menu_id']);
            $menu->set_menu_parent_id($newArray['menu_parent_id']);
            $menu->set_menu_type_id($newArray['menu_type_id']);
            $menu->set_menu_order($newArray['menu_order']);
            $menu->set_menu_link($newArray['menu_link']);
            $menu->set_menu_name($newArray['menu_name']);
            $menu->set_menu_desc($newArray['menu_desc']);
            $menu->set_menu_archived($newArray['menu_archived']);

            $menu->set_sub_menu_list($menu->getSubMenuItemList());
            $menuItemlist[$count] = $menu;
            $count++;
        }
        return $menuItemlist;
    }


    public function outputAsHtmlTable($id = "", $class = "", $menu_type_id)
    {
        $htmlTable = "<table id='$id' class='$class'>";
        $htmlTable = $htmlTable . "<tr>
                                        <th>ID</th>
                                        <th>Menu Title</th>
                                        <th>Link</th>
                                        <th>Order</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>";
        $menu_list = $this->getMenuItemListByMenuTypeId($menu_type_id);
        if (sizeof($menu_list) > 0) {
            foreach ($menu_list as $menu) {
                $htmlTable = $htmlTable.$menu->outputAsHtmlTableRow("");
            }
        }
        $htmlTable = $htmlTable . "</table>";
        return $htmlTable;
    }
}
?>
