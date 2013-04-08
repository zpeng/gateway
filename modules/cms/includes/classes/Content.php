<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Content
 *
 * @author
 */
class Content {
//put your code here

    private $_content_id;
    private $_author_name = "";
    private $_author_id;
    private $_content_description_list = [];
    private $_archived;

    public function get_content_id() {
        return $this->_content_id;
    }

    public function set_content_id($_content_id) {
        $this->_content_id = $_content_id;
    }
 
    public function get_author_name() {
        if ($this->_author_name == "") {
            $author = new User();
            $author->loadByID($this->get_author_id());
            $this->set_author_name($author->get_user_name());
        }
        return $this->_author_name;
    }

    public function set_author_name($_author_name) {
        $this->_author_name = $_author_name;
    }

    public function get_author_id() {
        return $this->_author_id;
    }

    public function set_author_id($_author_id) {
        $this->_author_id = $_author_id;
    }

    public function get_first_content_description() {
        if ($this->_content_description_list == null) {
            $this->set_content_description_list($this->getContentDescriptionList());
        }
        return $this->_content_description_list[0];
    }

    public function get_content_description_list() {
        if ($this->_content_description_list == null) {
            $this->set_content_description_list($this->getContentDescriptionList());
        }
        return $this->_content_description_list;
    }

    public function set_content_description_list($_content_description_list) {
        $this->_content_description_list = $_content_description_list;
    }

    public function get_archived() {
        return $this->_archived;
    }

    public function set_archived($_archived) {
        $this->_archived = $_archived;
    }

    public function load($_content_id) {
        $link = getConnection();

        $query="select 	content_id,
                        content_author_id, 
                        content_archived 
                from 	cms_content
                where   content_id = ".$_content_id;

        $result = executeNonUpdateQuery($link , $query, "Content.load()");
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->set_content_id($newArray['content_id']);
            $this->set_author_id($newArray['content_author_id']);
            $this->set_archived($newArray['content_archived']);

        }
    }

    public function getContentDescriptionList() {
        $link = getConnection();
        $count = 0;
        $content_description_list = null;
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
                  where content_id =  ".$this->get_content_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $content_description = new ContentDescription();
            $content_description->set_content_description_id($newArray['content_description_id']);
            $content_description->set_content_id($newArray['content_id']);
            $content_description->set_language_id($newArray['content_language_id']);
            $content_description->set_title($newArray['content_title']);
            $content_description->set_abstract($newArray['content_abstract']);
            $content_description->set_article($newArray['content_article']);
            $content_description->set_create_date($newArray['content_create_date']);
            $content_description->set_last_modify_date($newArray['content_last_modify_date']);
            $content_description->set_last_modify_by_user_id($newArray['content_last_modify_by']);
            $content_description->set_archived($newArray['content_description_archived']);



            $content_description_list[$count] = $content_description;
            $count++;
        }

        return $content_description_list;
    }

    public function loadContentDescriptionByLanguageID($language_id) {
        if (sizeof($this->getContentDescriptionList()) > 0 ) {
            foreach($this->getContentDescriptionList() as $_content_desc) {
                if ($_content_desc->get_language_id() == $language_id) {
                    return $_content_desc;
                }
            }
        }
        // no item match
        return null;
    }

    public function insert() {
        $link = getConnection();
        $query = " insert into cms_content
	(content_author_id, content_archived
	)
	values
	(".$this->get_author_id().", 'N'
	)";

        executeUpdateQuery($link , $query, "Content.insert()");

        //get the content id
        $this->set_content_id(mysql_insert_id($link));
        closeConnection($link);

        // for loop of content description
        if (sizeof($this->get_content_description_list()) > 0 ) {
            foreach($this->get_content_description_list() as $_content_desc) {
                $_content_desc->set_content_id($this->get_content_id());
                $_content_desc->insert();
            }
        }
    }

    public function delete() {
        $link = getConnection();
        $query = "  update  cms_content
                    set	    content_archived = 'Y'
                    where   content_id = ".$this->get_content_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function update() {
        // update the content descriptions
        $contentDescriptionList = $this->get_content_description_list();
        if (sizeof($contentDescriptionList) > 0) {
            foreach($contentDescriptionList as $contentDescription) {
                if ($contentDescription->get_content_description_id() == 0) {
                    $contentDescription->set_content_id($this->get_content_id());
                    $contentDescription->insert();
                }else {
                    $contentDescription->update();
                }
            }
        }
    }

}

?>
