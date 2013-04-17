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
            array_push($menuTypelist, $menuType);

        }
        return $menuTypelist;
    }

    public function getMenuItemListByMenuTypeId($menu_type_id)
    {
        $menuItemlist = [];
        $link = getConnection();

        $query = " SELECT   menu_id,
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
            array_push($menuItemlist, $menu);
        }
        return $menuItemlist;
    }

    public function outputMenuTypeListAsListbox($id = "", $class = "", $style = "")
    {
        $menuTypelist = $this->getMenuTypeList();
        $listbox = "<select name='$id' id='$id' class ='$class' style='$style' size='" . sizeof($menuTypelist) . "'>";
        foreach ($menuTypelist as $menuType) {
            $listbox = $listbox . "<option value='" . $menuType->get_menu_type_id() . "'>" . $menuType->get_menu_type_name() . "</option>";
        }
        return $listbox . "</select>";
    }

    function outputMenuListAsListbox($menu_type_id, $id = "", $class = "", $style = "")
    {
        $menulist = $this->getMenuItemListByMenuTypeId($menu_type_id);
        $field = "<select name='$id' id='$id' class ='$class' style='$style' size='5'>";
        $field = $field . "<option value='0'> As parent </option>";
        if (sizeof($menulist) > 0) {
            foreach ($menulist as $menu) {
                $field = $field . $menu->outputAsSelectOption("&nbsp;&nbsp;");
            }
        }
        $field = $field . "</select>";
        return $field;
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
                $htmlTable = $htmlTable . $menu->outputAsHtmlTableRow("");
            }
        }
        $htmlTable = $htmlTable . "</table>";
        return $htmlTable;
    }


    function outputListTypeAsListbox($id = '', $class = '', $style = '')
    {
        $field = "<select id='" . $id . "' name='" . $id . "' class='$class' style='$style' size='2'>";
        $field = $field . "<option  value='0'>&nbsp;&nbsp;-Customize Link</option>";
        $field = $field . "<option  value='1'>&nbsp;&nbsp;-Contents</option>";
        $field = $field . "</select>";
        return $field;
    }
}
?>
