<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of MenuDescription
 *
 * @author Administrator
 */
class MenuDescription {
//put your code here

    private $_menu_descritpion_id;
    private $_menu_id;
    private $_language_id;
    private $_language;
    private $_menu_name;
    private $_menu_description_archived;

    public function get_menu_descritpion_id() {
        return $this->_menu_descritpion_id;
    }

    public function set_menu_descritpion_id($_menu_descritpion_id) {
        $this->_menu_descritpion_id = $_menu_descritpion_id;
    }

    public function get_menu_id() {
        return $this->_menu_id;
    }

    public function set_menu_id($_menu_id) {
        $this->_menu_id = $_menu_id;
    }

    public function get_language_id() {
        return $this->_language_id;
    }

    public function set_language_id($_language_id) {
        $this->_language_id = $_language_id;
    }

    public function get_language() {
        if ($this->_language == null) {
            $language = new Language();
            $language->load($this->get_language_id());
            $this->set_language($language);
        }
        return $this->_language;
    }

    public function set_language($_language) {
        $this->_language = $_language;
    }

    public function get_menu_name() {
        return $this->_menu_name;
    }

    public function set_menu_name($_menu_name) {
        $this->_menu_name = $_menu_name;
    }

    public function get_menu_description_archived() {
        return $this->_menu_description_archived;
    }

    public function set_menu_description_archived($_menu_description_archived) {
        $this->_menu_description_archived = $_menu_description_archived;
    }

    public function load() {
        $link = getConnection();
        $query="select 	menu_description_id,
                        menu_id,
                        language_id,
                        menu_name,
                        menu_description_archived
                from    cms_menu_description
                where   menu_description_id = ".$this->get_menu_descritpion_id();

        $result = executeNonUpdateQuery($link, $query);

        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->set_menu_descritpion_id($newArray['menu_description_id']);
            $this->set_menu_id($newArray['menu_id']);
            $this->set_language_id($newArray['language_id']);
            $this->set_menu_name($newArray['menu_name']);
            $this->set_menu_description_archived($newArray['menu_description_archived']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = "insert into cms_menu_description
       (menu_id,
        language_id,
        menu_name,
	menu_description_archived)
	values
       (".$this->get_menu_id().",
        ".$this->get_language()->get_language_id().",
        '".$this->get_menu_name()."',
	'N')";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        $link = getConnection();
        $query = "  UPDATE cms_menu_description
                    SET    menu_description_archived    = 'Y'
                    WHERE  menu_description_id          = ".$this->get_menu_descritpion_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function update() {
        $link = getConnection();
        $query = "  UPDATE cms_menu_description
                    SET    menu_name   = '".$this->get_menu_name()."'
                    WHERE  menu_description_id        = ".$this->get_menu_descritpion_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }
}
?>
