<?php
namespace  modules\cms\includes\classes;

class MenuManager
{
    //put your code here
    public function getMenuTypeList()
    {
        $menuTypelist = [];
        $link = getConnection();

        $query = "SELECT menu_type_id         ,
                         menu_type_name       ,
                         menu_type_description,
                         active
                  FROM   cms_menu_type
                  WHERE  active = 'Y'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $menuType = new MenuType();
            $menuType->set_menu_type_id($newArray['menu_type_id']);
            $menuType->set_menu_type_name($newArray['menu_type_name']);
            $menuType->set_menu_type_description($newArray['menu_type_description']);
            $menuType->setActive($newArray['active']);
            array_push($menuTypelist, $menuType);

        }
        return $menuTypelist;
    }

    public function getMenuItemListByMenuTypeId($menu_type_id)
    {
        $menuItemlist = [];
        $link = getConnection();

        $query = " SELECT     menu_id,
                              menu_parent_id,
                              menu_type_id,
                              menu_order,
                              menu_link,
                              menu_name,
                              menu_desc,
                              active
                    FROM      cms_menu
                    WHERE     active = 'Y'
                    AND       menu_parent_id = 0
                    AND       menu_type_id = " . $menu_type_id . "
                    ORDER BY  menu_order";
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
            $menu->setActive($newArray['active']);

            $menu->set_sub_menu_list($menu->getSubMenuItemList());
            array_push($menuItemlist, $menu);
        }
        return $menuItemlist;
    }

    public function getMenuTypeListDataSource()
    {
        $menuTypelist = $this->getMenuTypeList();
        $data = array();
        if (sizeof($menuTypelist) > 0) {
            foreach ($menuTypelist as $menuType) {
                $data[$menuType->get_menu_type_name()] = $menuType->get_menu_type_id();
            }
        }
        $dataSource = array(
            "data" => $data
        );
        return $dataSource;
    }

    public function getMenuListDataSource($menu_type_id)
    {
        $menu_list = $this->getMenuItemListByMenuTypeId($menu_type_id);
        $data = array();
        $data["As parent"] = '0';
        if (sizeof($menu_list) > 0) {
            foreach ($menu_list as $menu) {
                $data = array_merge($data, $this->getMenuDataAsKeyValuePair($menu, "&nbsp;&nbsp;&nbsp;&nbsp;"));
            }
        }
        $dataSource = array(
            "data" => $data
        );
        return $dataSource;
    }

    private function getMenuDataAsKeyValuePair($menu, $padding = "")
    {
        $data = array();
        if ($menu->get_menu_parent_id() != "0") {
            //this a sub-menu, need to add padding
            $padding = $padding . "&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        $data[$menu->get_menu_name_with_padding($padding)] = $menu->get_menu_id();

        if (sizeof($menu->_sub_menu_list) > 0) {
            foreach ($menu->_sub_menu_list as $sub_menu) {
                $data = array_merge($data, $this->getMenuDataAsKeyValuePair($sub_menu, $padding));
            }
        }
        return $data;
    }

    public function getMenuTableDataSource($menu_type_id)
    {
        $menu_list = $this->getMenuItemListByMenuTypeId($menu_type_id);
        $data_source = array();
        $level = 0;
        if (sizeof($menu_list) > 0) {
            foreach ($menu_list as $menu) {
                $this->getMenuTableRowDataSet($data_source, $menu, $level);
            }
        }
        return $data_source;
    }

    private function getMenuTableRowDataSet(&$data_source, $menu,  $level)
    {

        array_push($data_source, array(
            "id" => $menu->get_menu_id(),
            'parent_id' => $menu->get_menu_parent_id(),  // the parent's index of  in this json
            'level' => $level,
            "title" => $menu->get_menu_name_with_padding(),
            "link" => $menu->get_menu_link(),
            "order" => $menu->get_menu_order(),
            "desc" => $menu->get_menu_desc(),
            "action" => ""
        ));
        $sub_menu_list = $menu->get_sub_menu_list();
        if (sizeof($sub_menu_list) > 0) {
            foreach ($sub_menu_list as $sub_menu) {
                $this->getMenuTableRowDataSet($data_source, $sub_menu, $level + 1);
            }
        }
    }

}
?>
