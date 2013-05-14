<?php
namespace  modules\cms\includes\classes;

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
}
?>
