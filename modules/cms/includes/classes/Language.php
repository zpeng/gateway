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
class Language {
//put your code here
    private $_language_id;
    private $_language_name;
    private $_language_initial;
    private $_language_icon;
    private $_language_archived;


    public function get_language_id() {
        return $this->_language_id;
    }

    public function set_language_id($_language_id) {
        $this->_language_id = $_language_id;
    }

    public function get_language_name() {
        return $this->_language_name;
    }

    public function set_language_name($_language_name) {
        $this->_language_name = $_language_name;
    }

    public function get_language_initial() {
        return $this->_language_initial;
    }

    public function set_language_initial($_language_initial) {
        $this->_language_initial = $_language_initial;
    }

    public function get_language_icon() {
        return $this->_language_icon;
    }

    public function get_language_icon_as_image() {
        return "<img border='0' width='18' height='12' src='../images/languageicons/".$this->_language_icon."'/>";
    }

    public function get_language_icon_as_image_for_site() {
        return "<img border='0' width='18' height='12'
                style='vertical-align:middle; margin-left:5px;'
src='images/languageicons/".$this->_language_icon."'/>";
    }

    public function set_language_icon($_language_icon) {
        $this->_language_icon = $_language_icon;
    }

    public function get_language_archived() {
        return $this->_language_archived;
    }

    public function set_language_archived($_language_archived) {
        $this->_language_archived = $_language_archived;
    }

    public function load($language_id) {
        $link = getConnection();
        $query="select 	language_id, language_name, language_initial,language_icon,language_archived
                from	cms_language
                where   language_id = ".$language_id;

        $result = executeNonUpdateQuery($link , $query);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_language_id($newArray['language_id']);
            $this->set_language_name($newArray['language_name']);
            $this->set_language_initial($newArray['language_initial']);
            $this->set_language_icon($newArray['language_icon']);
            $this->set_language_archived($newArray['language_archived']);
        }

        closeConnection($link);
    }

    public function delete() {
        $link = getConnection();

        $query = "  update cms_language
                    set language_archived = 'Y'
                    where language_id = ".$this->get_language_id();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

}
?>
