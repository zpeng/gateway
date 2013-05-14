<?php
namespace  modules\cms\includes\classes;

use modules\core\includes\classes\User;


class Content
{
//put your code here

    private $_content_id;
    private $_author_name = "";
    private $_author_id;
    private $_title;
    private $_article;
    private $_create_date;
    private $_last_modify_date;
    private $_last_modify_by;
    private $_last_modify_by_user_id;
    private $_archived;


    public function get_content_id()
    {
        return $this->_content_id;
    }

    public function set_content_id($_content_id)
    {
        $this->_content_id = $_content_id;
    }

    public function get_author_name()
    {
        if ($this->_author_name == "") {
            $author = new User();
            $author->loadByID($this->get_author_id());
            $this->set_author_name($author->get_user_name());
        }
        return $this->_author_name;
    }

    public function set_author_name($_author_name)
    {
        $this->_author_name = $_author_name;
    }

    public function get_author_id()
    {
        return $this->_author_id;
    }

    public function set_author_id($_author_id)
    {
        $this->_author_id = $_author_id;
    }

    public function get_title()
    {
        return $this->_title;
    }

    public function set_title($_title)
    {
        $this->_title = $_title;
    }

    public function get_article()
    {
        return $this->_article;
    }

    public function set_article($_article)
    {
        $this->_article = $_article;
    }

    public function get_create_date()
    {
        return $this->_create_date;
    }

    public function set_create_date($_create_date)
    {
        $this->_create_date = $_create_date;
    }

    public function get_last_modify_date()
    {
        return $this->_last_modify_date;
    }

    public function set_last_modify_date($_last_modify_date)
    {
        $this->_last_modify_date = $_last_modify_date;
    }

    public function get_last_modify_by()
    {
        if ($this->_last_modify_by == null) {
            $author = new User();
            $author->loadByID($this->_last_modify_by_user_id);
            $this->set_last_modify_by($author->get_user_name());
        }
        return $this->_last_modify_by;
    }

    public function set_last_modify_by($_last_modify_by)
    {
        $this->_last_modify_by = $_last_modify_by;
    }

    public function get_last_modify_by_user_id()
    {
        return $this->_last_modify_by_user_id;
    }

    public function set_last_modify_by_user_id($_last_modify_by_user_id)
    {
        $this->_last_modify_by_user_id = $_last_modify_by_user_id;
    }

    public function get_archived()
    {
        return $this->_archived;
    }

    public function set_archived($_archived)
    {
        $this->_archived = $_archived;
    }

    public function loadByID($_content_id)
    {
        $link = getConnection();

        $query = "SELECT
                      content_id,
                      content_author_id,
                      content_title,
                      content_article,
                      content_create_date,
                      content_last_modify_by,
                      content_last_modify_date,
                      content_archived
                    FROM cms_content
                where   content_id = " . $_content_id;

        $result = executeNonUpdateQuery($link, $query, "Content.load()");
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->set_content_id($newArray['content_id']);
            $this->set_author_id($newArray['content_author_id']);
            $this->set_title($newArray['content_title']);
            $this->set_article($newArray['content_article']);
            $this->set_create_date($newArray['content_create_date']);
            $this->set_last_modify_date($newArray['content_last_modify_date']);
            $this->set_last_modify_by_user_id($newArray['content_last_modify_by']);
            $this->set_archived($newArray['content_archived']);
        }
    }

    public function insert()
    {
        $link = getConnection();
        $query = "INSERT INTO cms_content
                                (content_author_id,
                                 content_title,
                                 content_article,
                                 content_create_date,
                                 content_last_modify_by,
                                 content_last_modify_date,
                                 content_archived)
                    VALUES (".$this->get_author_id().",
                            '".$this->get_title()."',
                            '".$this->get_article()."',
                            now(),
                            ".$this->get_author_id().",
                            now(),
                            'N')";

        executeUpdateQuery($link, $query, "Content.insert()");
        closeConnection($link);
    }

    public function delete()
    {
        $link = getConnection();
        $query = "  update  cms_content
                    set	    content_archived = 'Y'
                    where   content_id = " . $this->get_content_id();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function update() {
        $link = getConnection();
        $query = "  update  cms_content
                    set	content_title = '".$this->get_title()."',
                            content_article = '".$this->get_article()."',
                            content_last_modify_by = ".$this->get_last_modify_by_user_id().",
                            content_last_modify_date = now()
                    where   content_id = ".$this->get_content_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

}

?>
