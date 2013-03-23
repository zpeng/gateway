<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of EmailTemplate
 *
 * @author ziyang
 */
class EmailTemplate {
    //put your code here

    private $_email_template_id;
    private $_email_template_key;
    private $_email_template_title;
    private $_email_template;
    private $_email_template_comment;

    public function get_email_template_id() {
        return $this->_email_template_id;
    }

    public function set_email_template_id($_email_template_id) {
        $this->_email_template_id = $_email_template_id;
    }

    public function get_email_template_key() {
        return $this->_email_template_key;
    }

    public function set_email_template_key($_email_template_key) {
        $this->_email_template_key = $_email_template_key;
    }

    public function get_email_template_title() {
        return $this->_email_template_title;
    }

    public function set_email_template_title($_email_template_title) {
        $this->_email_template_title = $_email_template_title;
    }

    public function get_email_template() {
        return $this->_email_template;
    }

    public function set_email_template($_email_template) {
        $this->_email_template = $_email_template;
    }

    public function get_email_template_comment() {
        return $this->_email_template_comment;
    }

    public function set_email_template_comment($_email_template_comment) {
        $this->_email_template_comment = $_email_template_comment;
    }

    public function loadByID($email_template_id) {
        $link = getConnection();
        $query="select 	email_template_id, 
                        email_template_key, 
                        email_template_title, 
                        email_template, 
                        email_template_comment 
                from    tb_email_template 
                where   email_template_id = ".$email_template_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_email_template_id($newArray['email_template_id']);
            $this->set_email_template_key($newArray['email_template_key']);
            $this->set_email_template_title($newArray['email_template_title']);
            $this->set_email_template(stripslashes($newArray['email_template']));
            $this->set_email_template_comment($newArray['email_template_comment']);
        }
    }

    public function loadByKey($email_template_key) {
        $link = getConnection();
        $query="select 	email_template_id,
                        email_template_key,
                        email_template_title,
                        email_template,
                        email_template_comment
                from    tb_email_template
                where   email_template_key = '".$email_template_key."'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_email_template_id($newArray['email_template_id']);
            $this->set_email_template_key($newArray['email_template_key']);
            $this->set_email_template_title($newArray['email_template_title']);
            $this->set_email_template(stripslashes($newArray['email_template']));
            $this->set_email_template_comment($newArray['email_template_comment']);
        }
    }

    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_email_template
                  SET    email_template     = '".$this->get_email_template()."' ,
                         email_template_title = '".$this->get_email_template_title()."'
                  WHERE  email_template_id  = ".$this->get_email_template_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }
}
?>
