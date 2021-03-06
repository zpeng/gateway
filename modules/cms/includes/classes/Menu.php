<?php
namespace  modules\cms\includes\classes;

class Menu
{
//put your code here

    public $_menu_id;
    public $_menu_parent_id;
    public $_menu_type;
    public $_menu_type_id;
    public $_menu_order;
    public $_menu_link;
    public $_menu_name;
    public $_menu_desc;
    public $_sub_menu_list = array();
    public $_active;

    public function setActive($active)
    {
        $this->_active = $active;
    }

    public function getActive()
    {
        return $this->_active;
    }

    public function get_menu_id()
    {
        return $this->_menu_id;
    }

    public function set_menu_id($_menu_id)
    {
        $this->_menu_id = $_menu_id;
    }

    public function get_menu_name()
    {
        return $this->_menu_name;
    }

    public function get_menu_name_with_padding($padding = "")
    {
        $output = $padding;
        if ($this->get_menu_parent_id() != "0") {
            $output = $output . "|_ " . $this->_menu_name;
        } else {
            $output = $output . $this->_menu_name;
        }
        return $output;
    }

    public function set_menu_name($_menu_name)
    {
        $this->_menu_name = $_menu_name;
    }

    public function get_menu_parent_id()
    {
        return $this->_menu_parent_id;
    }

    public function set_menu_parent_id($_menu_parent_id)
    {
        $this->_menu_parent_id = $_menu_parent_id;
    }

    public function get_menu_type()
    {
        if ($this->_menu_type == null) {
            $menuType = new MenuType();
            $menuType->load($this->get_menu_type_id());
            $this->set_menu_type($menuType);
        }
        return $this->_menu_type;
    }

    public function set_menu_type($_menu_type)
    {
        $this->_menu_type = $_menu_type;
    }

    public function get_menu_type_id()
    {
        return $this->_menu_type_id;
    }

    public function set_menu_type_id($_menu_type_id)
    {
        $this->_menu_type_id = $_menu_type_id;
    }

    public function get_menu_order()
    {
        return $this->_menu_order;
    }

    public function set_menu_order($_menu_order)
    {
        $this->_menu_order = $_menu_order;
    }

    public function get_menu_link()
    {
        return $this->_menu_link;
    }

    public function set_menu_link($_menu_link)
    {
        $this->_menu_link = $_menu_link;
    }

    public function get_sub_menu_list()
    {
        return $this->_sub_menu_list;
    }

    public function set_sub_menu_list($_sub_menu_list)
    {
        $this->_sub_menu_list = $_sub_menu_list;
    }

    public function get_menu_desc()
    {
        return $this->_menu_desc;
    }

    public function set_menu_desc($_menu_desc)
    {
        $this->_menu_desc = $_menu_desc;
    }

    public function load($menu_id)
    {
        $link = getConnection();
        $query = " SELECT   menu_id,
                          menu_parent_id,
                          menu_type_id,
                          menu_order,
                          menu_link,
                          menu_name,
                          menu_desc,
                          active
                  FROM cms_menu
                WHERE  active = 'Y'
                AND    menu_id = " . $menu_id;

        $result = executeNonUpdateQuery($link, $query);

        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->set_menu_id($newArray['menu_id']);
            $this->set_menu_parent_id($newArray['menu_parent_id']);
            $this->set_menu_type_id($newArray['menu_type_id']);
            $this->set_menu_order($newArray['menu_order']);
            $this->set_menu_link($newArray['menu_link']);
            $this->set_menu_name($newArray['menu_name']);
            $this->set_menu_desc($newArray['menu_desc']);
            $this->setActive($newArray['active']);

            $this->set_sub_menu_list($this->getSubMenuItemList());

        }
    }

    public function getSubMenuItemList()
    {
        $link = getConnection();
        $query = "SELECT  menu_id,
                          menu_parent_id,
                          menu_type_id,
                          menu_order,
                          menu_link,
                          menu_name,
                          menu_desc,
                          active
                FROM   cms_menu
                WHERE  active = 'Y'
                AND    menu_parent_id = " . $this->get_menu_id() . "
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
            $menu->setActive($newArray['active']);

            $menu->set_sub_menu_list($menu->getSubMenuItemList());
            array_push($this->_sub_menu_list, $menu);
        }

        return $this->_sub_menu_list;
    }

    public function insert()
    {
        $link = getConnection();
        $query = "INSERT    INTO   cms_menu
                               (
                                      menu_parent_id  ,
                                      menu_type_id    ,
                                      menu_order      ,
                                      menu_link       ,
                                      menu_name,
                                      menu_desc
                               )
                               VALUES
                               (
                                      " . $this->get_menu_parent_id() . ",
                                      " . $this->get_menu_type_id() . ",
                                      " . $this->get_menu_order() . ",
                                      '" . $this->get_menu_link() . "',
                                      '" . $this->get_menu_name() . "',
                                      '" . $this->get_menu_desc() . "'
                               )";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function update()
    {
        $link = getConnection();
        $query = "  UPDATE cms_menu
                SET    menu_name   = '" . $this->get_menu_name() . "',
                       menu_order       = " . $this->get_menu_order() . ",
                       menu_link        = '" . $this->get_menu_link() . "',
                       menu_desc        = '" . $this->get_menu_desc() . "'
                WHERE  menu_id          = " . $this->get_menu_id();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function delete()
    {
        $link = getConnection();
        $query = "  UPDATE cms_menu
                    SET    active    = 'N'
                    WHERE  menu_id          = " . $this->get_menu_id();
        executeUpdateQuery($link, $query);
        closeConnection($link);

        foreach ($this->_sub_menu_list as $sub_menu) {
            $sub_menu->delete();
        }
    }

}
?>
