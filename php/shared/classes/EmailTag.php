<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of EmailTag
 *
 * @author ziyang
 */
class EmailTag {
    //put your code here
    private $_email_tag_id;
    private $_email_tag_group_id;
    private $_email_tag_name;
    private $_email_tag;
    private $_email_tag_description;



    public function get_email_tag_id() {
        return $this->_email_tag_id;
    }

    public function set_email_tag_id($_email_tag_id) {
        $this->_email_tag_id = $_email_tag_id;
    }

    public function get_email_tag_group_id() {
        return $this->_email_tag_group_id;
    }

    public function set_email_tag_group_id($_email_tag_group_id) {
        $this->_email_tag_group_id = $_email_tag_group_id;
    }
    
    public function get_email_tag_name() {
        return $this->_email_tag_name;
    }

    public function set_email_tag_name($_email_tag_name) {
        $this->_email_tag_name = $_email_tag_name;
    }

    public function get_email_tag() {
        return $this->_email_tag;
    }

    public function set_email_tag($_email_tag) {
        $this->_email_tag = $_email_tag;
    }

    public function get_email_tag_description() {
        return $this->_email_tag_description;
    }

    public function set_email_tag_description($_email_tag_description) {
        $this->_email_tag_description = $_email_tag_description;
    }


}
?>
