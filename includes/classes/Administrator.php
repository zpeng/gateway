<?php
class Administrator {
    public  $admin_id;
    public  $admin_name;
    public  $admin_password;
    public  $admin_archived;

    public function get_admin_id() {
        return $this->admin_id;
    }

    public function set_admin_id($admin_id) {
        $this->admin_id = $admin_id;
    }

    public function get_admin_name() {
        return $this->admin_name;
    }

    public function set_admin_name($admin_name) {
        $this->admin_name = $admin_name;
    }

    public function get_admin_password() {
        return $this->admin_password;
    }

    public function set_admin_password($admin_password) {
        $this->admin_password = $admin_password;
    }

    public function get_admin_archived() {
        return $this->admin_archived;
    }

    public function set_admin_archived($admin_archived) {
        $this->admin_archived = $admin_archived;
    }

    public function loadByEmail($email) {
        $link = getConnection();

        $query = " select 	admin_id,
                        admin_name,
                        admin_password,
                        admin_archived
                from    core_admin
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
                from    core_admin
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
                    INTO   core_admin
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
        $query = " UPDATE core_admin
               SET    admin_password = '".$newPassword."'
               WHERE  admin_id = ".$this->get_admin_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        //delete user account
        $link = getConnection();
        $query = " UPDATE core_admin
                   SET    admin_archived = 'Y'
                   WHERE  admin_id = ".$this->get_admin_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function toJSON(){
        return  str_replace('\\u0000', "", json_encode( (array) $this ));
    }

}
?>
