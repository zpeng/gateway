<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of User
 *
 * @author
 */
class Administrator {
    private $_admin_id;
    private $_admin_name;
    private $_admin_password;
    private $_admin_archived;

    public function get_admin_id() {
        return $this->_admin_id;
    }

    public function set_admin_id($_admin_id) {
        $this->_admin_id = $_admin_id;
    }

    public function get_admin_name() {
        return $this->_admin_name;
    }

    public function set_admin_name($_admin_name) {
        $this->_admin_name = $_admin_name;
    }

    public function get_admin_password() {
        return $this->_admin_password;
    }

    public function set_admin_password($_admin_password) {
        $this->_admin_password = $_admin_password;
    }

    public function get_admin_archived() {
        return $this->_admin_archived;
    }

    public function set_admin_archived($_admin_archived) {
        $this->_admin_archived = $_admin_archived;
    }

    public function loadByEmail($email) {
        $link = getConnection();
        $password = md5($password);

        $query = " select 	admin_id,
                        admin_name,
                        admin_password,
                        admin_archived
                from    tb_administrator
                where   admin_archived =   'N'
                and     admin_name =       '".$email."'";



        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_admin_id($newArray['admin_id']);
            $this->set_admin_name($newArray['admin_name']);
            $this->set_admin_password($newArray['admin_password']);
            $this->set_admin_archived($newArray['admin_archived']);
        }
    }

    public function loadByID($id) {
        $link = getConnection();
        $query = " select admin_id,
                        admin_name,
                        admin_password,
                        admin_archived
                from    tb_administrator
                where   admin_archived =   'N'
                and     admin_id =  ".$id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_admin_id($newArray['admin_id']);
            $this->set_admin_name($newArray['admin_name']);
            $this->set_admin_password($newArray['admin_password']);
            $this->set_admin_archived($newArray['admin_archived']);
        }
    }

    public function insert() {
        $link = getConnection();

        $query = "  INSERT
                    INTO   tb_administrator
                           (
                                  admin_name           ,
                                  admin_password        ,
                                  admin_archived
                           )
                           VALUES
                           (
                                  '".$this->get_admin_name()."'           ,
                                  '".$this->get_admin_password()."'        ,
                                  'N'
                           )";

        executeUpdateQuery($link , $query);

        $admin_id = mysql_insert_id($link);
        $this->set_admin_id($admin_id);
        closeConnection($link);

    }

    public function updatePassword($new_password) {
        $link = getConnection();
        $newPassword = md5($new_password);
        $query = " UPDATE tb_administrator
               SET    admin_password = '".$newPassword."'
               WHERE  admin_id = ".$this->get_admin_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {

        //delete user account
        $link = getConnection();
        $query = " UPDATE tb_administrator
                   SET    admin_archived = 'Y'
                   WHERE  admin_id = ".$this->get_admin_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

}
?>
