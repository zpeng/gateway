<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuType
 *
 * @author
 */
class MenuType {
//put your code here
    private $_menu_type_id;
    private $_menu_type_name;
    private $_menu_type_description;
    private $_menu_type_archived;

    public function get_menu_type_id() {
        return $this->_menu_type_id;
    }

    public function set_menu_type_id($_menu_type_id) {
        $this->_menu_type_id = $_menu_type_id;
    }

    public function get_menu_type_name() {
        return $this->_menu_type_name;
    }

    public function set_menu_type_name($_menu_type_name) {
        $this->_menu_type_name = $_menu_type_name;
    }

    public function get_menu_type_description() {
        return $this->_menu_type_description;
    }

    public function set_menu_type_description($_menu_type_description) {
        $this->_menu_type_description = $_menu_type_description;
    }

    public function get_menu_type_archived() {
        return $this->_menu_type_archived;
    }

    public function set_menu_type_archived($_menu_type_archived) {
        $this->_menu_type_archived = $_menu_type_archived;
    }

    public function load($menu_type_id) {
        $link = getConnection();

        $query="SELECT menu_type_id         ,
                       menu_type_name       ,
                       menu_type_description,
                       menu_type_archived
                FROM   cms_menu_type
                WHERE  menu_type_archived = 'N'
                   AND menu_type_id       = ".$menu_type_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_menu_type_id($newArray['menu_type_id']);
            $this->set_menu_type_name($newArray['menu_type_name']);
            $this->set_menu_type_description($newArray['menu_type_description']);
            $this->set_menu_type_archived($newArray['menu_type_archived']);
        }
    }

    public function getMenuItemListByMenuType() {
        $menuItemlist;
        $count = 0;
        $link = getConnection();

        $query="    SELECT menu_id         ,
                       menu_parent_id  ,
                       menu_type_id    ,
                       menu_order      ,
                       menu_link       ,
                       menu_archived
                FROM   cms_menu
                WHERE  menu_archived = 'N'
                AND    menu_parent_id = 0
                AND    menu_type_id = ".$this->get_menu_type_id()."
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
            $menu->set_menu_archived($newArray['menu_archived']);

            $menu->set_menu_description_list($menu->getMenuDescriptionList());

            $subMenuItemlist = $menu->getSubMenuItemList();
            if($subMenuItemlist != null) {
                $menu->set_sub_menu_list($subMenuItemlist);
            }else {
                $menu->set_sub_menu_list(null);
            }

            $menuItemlist[$count] = $menu;
            $count++;
        }
        return $menuItemlist;
    }

}
?>
