<?php
namespace  modules\cms\includes\classes;

class MenuType {
//put your code here
    private $_menu_type_id;
    private $_menu_type_name;
    private $_menu_type_description;
    private $_active;

    public function setActive($active)
    {
        $this->_active = $active;
    }

    public function getActive()
    {
        return $this->_active;
    }

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

    public function load($menu_type_id) {
        $link = getConnection();

        $query="SELECT menu_type_id         ,
                       menu_type_name       ,
                       menu_type_description,
                       active
                FROM   cms_menu_type
                WHERE  active = 'Y'
                   AND menu_type_id       = ".$menu_type_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_menu_type_id($newArray['menu_type_id']);
            $this->set_menu_type_name($newArray['menu_type_name']);
            $this->set_menu_type_description($newArray['menu_type_description']);
            $this->setActive($newArray['active']);
        }
    }
}
?>
