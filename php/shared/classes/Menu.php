<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Menu
 *
 * @author
 */
class Menu {
//put your code here

    private $_menu_id;
    private $_menu_parent_id;
    private $_menu_type;
    private $_menu_type_id;
    private $_menu_order;
    private $_menu_link;
    private $_menu_archived;
    private $_menu_description_list;
    private $_sub_menu_list;


    public function get_menu_id() {
        return $this->_menu_id;
    }

    public function set_menu_id($_menu_id) {
        $this->_menu_id = $_menu_id;
    }

    public function get_menu_parent_id() {
        return $this->_menu_parent_id;
    }

    public function set_menu_parent_id($_menu_parent_id) {
        $this->_menu_parent_id = $_menu_parent_id;
    }

    public function get_menu_type() {
        if ($this->_menu_type == null) {
            $menuType = new MenuType();
            $menuType->load($this->get_menu_type_id());
            $this->set_menu_type($menuType);
        }
        return $this->_menu_type;
    }

    public function set_menu_type($_menu_type) {
        $this->_menu_type = $_menu_type;
    }

    public function get_menu_type_id() {
        return $this->_menu_type_id;
    }

    public function set_menu_type_id($_menu_type_id) {
        $this->_menu_type_id = $_menu_type_id;
    }

    public function get_menu_order() {
        return $this->_menu_order;
    }

    public function set_menu_order($_menu_order) {
        $this->_menu_order = $_menu_order;
    }

    public function get_menu_link() {
        return $this->_menu_link;
    }

    public function set_menu_link($_menu_link) {
        $this->_menu_link = $_menu_link;
    }

    public function get_menu_archived() {
        return $this->_menu_archived;
    }

    public function set_menu_archived($_menu_archived) {
        $this->_menu_archived = $_menu_archived;
    }

    public function get_sub_menu_list() {
        return $this->_sub_menu_list;
    }

    public function set_sub_menu_list($_sub_menu_list) {
        $this->_sub_menu_list = $_sub_menu_list;
    }

    public function get_menu_description_list() {
        return $this->_menu_description_list;
    }

    public function set_menu_description_list($_menu_description_list) {
        $this->_menu_description_list = $_menu_description_list;
    }


    public function load($menu_id) {
        $link = getConnection();
        $query="SELECT menu_id         ,
                       menu_parent_id  ,
                       menu_type_id    ,
                       menu_order      ,
                       menu_link       ,
                       menu_archived
                FROM   tb_menu
                WHERE  menu_archived = 'N'
                AND    menu_id = ".$menu_id;

        $result = executeNonUpdateQuery($link, $query);

        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->set_menu_id($newArray['menu_id']);
            $this->set_menu_parent_id($newArray['menu_parent_id']);
            $this->set_menu_type_id($newArray['menu_type_id']);
            $this->set_menu_order($newArray['menu_order']);
            $this->set_menu_link($newArray['menu_link']);
            $this->set_menu_archived($newArray['menu_archived']);

            $this->set_menu_description_list($this->getMenuDescriptionList());
        }
    }

    public function getMenuDescriptionList() {
        $menuDescriptionList;
        $count = 0;
        $link = getConnection();
        $query="select 	menu_description_id,
                        menu_id,
                        language_id,
                        menu_name,
                        menu_description_archived
                from    tb_menu_description
                where   menu_id = ".$this->get_menu_id();

        $result = executeNonUpdateQuery($link, $query);

        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $menuDescription = new MenuDescription();
            $menuDescription->set_menu_descritpion_id($newArray['menu_description_id']);
            $menuDescription->set_menu_id($newArray['menu_id']);
            $menuDescription->set_language_id($newArray['language_id']);
            $menuDescription->set_menu_name($newArray['menu_name']);
            $menuDescription->set_menu_description_archived($newArray['menu_description_archived']);

            $menuDescriptionList[$count] =$menuDescription;
            $count ++;
        }
        return $menuDescriptionList;
    }

    public function getSubMenuItemList() {
        $menuItemlist = null;
        $count = 0;
        $link = getConnection();
        $query="SELECT menu_id         ,
                       menu_parent_id  ,
                       menu_type_id    ,
                       menu_order      ,
                       menu_link       ,
                       menu_archived
                FROM   tb_menu
                WHERE  menu_archived = 'N'
                AND    menu_parent_id = ".$this->get_menu_id()."
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

    public function insert() {
        $link = getConnection();
        $query = "INSERT    INTO   tb_menu
                               (
                                      menu_parent_id  ,
                                      menu_type_id    ,
                                      menu_order      ,
                                      menu_link       ,
                                      menu_archived
                               )
                               VALUES
                               (
                                      ".$this->get_menu_parent_id()."  ,
                                      ".$this->get_menu_type_id()."    ,
                                      ".$this->get_menu_order()."      ,
                                      '".$this->get_menu_link()."'       ,
                                      'N'
                               )";

        executeUpdateQuery($link , $query);

        $menu_id = mysql_insert_id($link);
        closeConnection($link);

        if (sizeof($this->get_menu_description_list())>0) {
            $menu_description = new MenuDescription();
            foreach($this->get_menu_description_list() as $menu_description) {
                $menu_description->set_menu_id($menu_id);
                $menu_description->insert();
            }
        }
    }

    public function update() {
        $link = getConnection();
        $query = "  UPDATE tb_menu
                SET    menu_parent_id   = ".$this->get_menu_parent_id().",
                       menu_type_id     = ".$this->get_menu_type_id().",
                       menu_order       = ".$this->get_menu_order().",
                       menu_link        = '".$this->get_menu_link()."',
                       menu_archived    = 'N'
                WHERE  menu_id          = ".$this->get_menu_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);

        if (sizeof($this->get_menu_description_list())>0) {
            $menu_description = new MenuDescription();
            foreach($this->get_menu_description_list() as $menu_description) {
                if ($menu_description->get_menu_descritpion_id() == 0) {
                    $menu_description->set_menu_id($this->get_menu_id());
                    $menu_description->insert();
                }else {
                    $menu_description->update();
                }

            }
        }
    }

    public function delete() {
        $link = getConnection();
        $query = "  UPDATE tb_menu
                    SET    menu_archived    = 'Y'
                    WHERE  menu_id          = ".$this->get_menu_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function getDefaultMenuDescription() {
        if (sizeof($this->get_menu_description_list()) > 0) {
            $menuDescription = new MenuDescription();
            $menuDescriptionList = $this->get_menu_description_list();
            $menuDescription = $menuDescriptionList[0];
            return $menuDescription;
        }else {
            return null;
        }
    }


    public function loadMenuDescriptionByLanguageID($language_id) {
        if (sizeof($this->getMenuDescriptionList()) > 0 ) {
            foreach($this->getMenuDescriptionList() as $_menu_desc) {
                if ($_menu_desc->get_language_id() == $language_id) {
                    return $_menu_desc;
                }
            }
        }
        // no item match
        return null;
    }
}
?>
