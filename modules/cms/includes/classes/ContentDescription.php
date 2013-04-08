<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ContentDescription
 *
 * @author Administrator
 */
class ContentDescription {
//put your code here
    private $_content_description_id;
    private $_content_id;
    private $_language;
    private $_language_id;
    private $_title;
    private $_abstract;
    private $_article;
    private $_create_date;
    private $_last_modify_date;
    private $_last_modify_by;
    private $_last_modify_by_user_id;
    private $_archived;


    public function get_content_description_id() {
        return $this->_content_description_id;
    }

    public function set_content_description_id($_content_description_id) {
        $this->_content_description_id = $_content_description_id;
    }

    public function get_content_id() {
        return $this->_content_id;
    }

    public function set_content_id($_content_id) {
        $this->_content_id = $_content_id;
    }

    public function get_language() {
        if ($this->_language ==null) {
            $language = new Language();
            $language->load($this->_language_id);
            $this->set_language($language);
        }
        return $this->_language;
    }

    public function set_language($_language) {
        $this->_language = $_language;
    }

    public function get_language_id() {
        return $this->_language_id;
    }

    public function set_language_id($_language_id) {
        $this->_language_id = $_language_id;
    }

    public function get_title() {
        return $this->_title;
    }

    public function set_title($_title) {
        $this->_title = $_title;
    }

    public function get_abstract() {
        return $this->_abstract;
    }

    public function set_abstract($_abstract) {
        $this->_abstract = $_abstract;
    }

    public function get_article() {
        return $this->_article;
    }

    public function set_article($_article) {
        $this->_article = $_article;
    }

    public function get_create_date() {
        return $this->_create_date;
    }

    public function set_create_date($_create_date) {
        $this->_create_date = $_create_date;
    }

    public function get_last_modify_date() {
        return $this->_last_modify_date;
    }

    public function set_last_modify_date($_last_modify_date) {
        $this->_last_modify_date = $_last_modify_date;
    }

    public function get_last_modify_by() {
        if ($this->_last_modify_by == null) {
            $author = new User();
            $author->loadByID($this->_last_modify_by_user_id);
            $this->set_last_modify_by($author->get_user_name());
        }
        return $this->_last_modify_by;
    }

    public function set_last_modify_by($_last_modify_by) {
        $this->_last_modify_by = $_last_modify_by;
    }

    public function get_last_modify_by_user_id() {
        return $this->_last_modify_by_user_id;
    }

    public function set_last_modify_by_user_id($_last_modify_by_user_id) {
        $this->_last_modify_by_user_id = $_last_modify_by_user_id;
    }

    public function get_archived() {
        return $this->_archived;
    }

    public function set_archived($_archived) {
        $this->_archived = $_archived;
    }



    public function load($content_description_id) {
        $link = getConnection();

        $query=" select content_description_id,
                        content_id,
                        content_language_id,
                        content_title,
                        content_abstract,
                        content_article,
                        content_create_date,
                        content_last_modify_by,
                        content_last_modify_date,
                        content_description_archived
                        from cms_content_description
                        where content_description_id =  ".$content_description_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {

            $this->set_content_description_id($newArray['content_description_id']);
            $this->set_content_id($newArray['content_id']);
            $this->set_language_id($newArray['content_language_id']);
            $this->set_title($newArray['content_title']);
            $this->set_abstract($newArray['content_abstract']);
            $this->set_article($newArray['content_article']);
            $this->set_create_date($newArray['content_create_date']);
            $this->set_last_modify_date($newArray['content_last_modify_date']);
            $this->set_last_modify_by_user_id($newArray['content_last_modify_by']);
            $this->set_archived($newArray['content_archived']);


       }
    }

    public function update() {
        $link = getConnection();
        $query = "  update  cms_content_description
                    set	content_title = '".$this->get_title()."',
                            content_abstract = '".$this->get_abstract()."',
                            content_article = '".$this->get_article()."',
                            content_last_modify_by = ".$this->get_last_modify_by_user_id().",
                            content_last_modify_date = now()
                    where   content_description_id = ".$this->get_content_description_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);


    }

    public function delete() {
        $link = getConnection();
        $query = "  update  cms_content_description
                    set	    content_description_archived = 'Y'
                    where   content_description_id = ".$this->get_content_description_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function insert() {
        $link = getConnection();
        $query = "  insert into cms_content_description
                   (content_id, content_language_id,
                    content_title,
                    content_abstract,
                    content_article,
                    content_create_date,
                    content_last_modify_by,
                    content_last_modify_date,
                    content_description_archived
                    )
                    values
                   (".$this->get_content_id().",
                    ".$this->get_language_id().",
                    '".$this->get_title()."',
                    '".$this->get_abstract()."',
                    '".$this->get_article()."',
                    now(),
                    ".$this->get_last_modify_by_user_id().",
                    now(),
                    'N'
                    )";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

}
?>
