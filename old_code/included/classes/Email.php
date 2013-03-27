<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author ziyang
 */
class Email {
    //put your code here
    private $_recipient;
    private $_subject;
    private $_message;

    public function get_recipient() {
        return $this->_recipient;
    }

    public function set_recipient($_recipient) {
        $this->_recipient = $_recipient;
    }

    public function get_subject() {
        return $this->_subject;
    }

    public function set_subject($_subject) {
        $this->_subject = $_subject;
    }

    public function get_message() {
        return $this->_message;
    }

    public function set_message($_message) {
        $this->_message = $_message;
    }

    

}
?>
