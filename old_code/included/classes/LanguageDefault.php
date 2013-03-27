<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Language
 *
 * @author Administrator
 */
class LanguageDefault {
//put your code here
    private $_language_default_default_id;
    private $_language_default_name;
    private $_language_default_initial;
    private $_language_default_icon;
    private $_language_default_archived;

    
    public function get_language_default_id() {
        return $this->_language_default_id;
    }

    public function set_language_default_id($_language_default_id) {
        $this->_language_default_id = $_language_default_id;
    }

    public function get_language_default_name() {
        return $this->_language_default_name;
    }

    public function set_language_default_name($_language_default_name) {
        $this->_language_default_name = $_language_default_name;
    }

    public function get_language_default_initial() {
        return $this->_language_default_initial;
    }

    public function set_language_default_initial($_language_default_initial) {
        $this->_language_default_initial = $_language_default_initial;
    }

    public function get_language_default_icon() {
        return $this->_language_default_icon;
    }

    public function set_language_default_icon($_language_default_icon) {
        $this->_language_default_icon = $_language_default_icon;
    }

    public function get_language_default_archived() {
        return $this->_language_default_archived;
    }

    public function set_language_default_archived($_language_default_archived) {
        $this->_language_default_archived = $_language_default_archived;
    }

    public function load($language_default_id) {
        $link = getConnection();
        $query="select 	language_default_id, language_default_name, language_default_initial,language_default_icon,language_default_archived
                from	tb_language_default
                where   language_default_id = ".$language_default_id;

        $result = executeNonUpdateQuery($link , $query);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_language_default_id($newArray['language_default_id']);
            $this->set_language_default_name($newArray['language_default_name']);
            $this->set_language_default_initial($newArray['language_default_initial']);
            $this->set_language_default_icon($newArray['language_default_icon']);
            $this->set_language_default_archived($newArray['language_default_archived']);
        }

        closeConnection($link);
    }

    public function insertToLanguageTable() {
        $link = getConnection();

        $query = "insert into tb_language
	       (language_name, language_initial, language_icon, language_archived)
	       select 	language_default_name, language_default_initial, 
                        language_default_icon, 
                        language_default_archived
                from	tb_language_default 
                where   language_default_id = ".$this->get_language_default_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

}
?>
