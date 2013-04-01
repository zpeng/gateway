<?php
class User {
    public  $user_id;
    public  $user_name;
    public  $user_password;
    public  $user_archived;
    public  $accessModuleNameList = [];
    public  $accessModuleCodeList = [];
    public  $accessModuleIDList = [];

    public function get_user_id() {
        return $this->user_id;
    }

    public function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    public function get_user_name() {
        return $this->user_name;
    }

    public function set_user_name($user_name) {
        $this->user_name = $user_name;
    }

    public function get_user_password() {
        return $this->user_password;
    }

    public function set_user_password($user_password) {
        $this->user_password = $user_password;
    }

    public function get_user_archived() {
        return $this->user_archived;
    }

    public function set_user_archived($user_archived) {
        $this->user_archived = $user_archived;
    }

    public function loadByEmail($email) {
        $link = getConnection();

        $query = " select 	user_id,
                        user_name,
                        user_password,
                        user_archived
                from    core_user
                where   user_archived =   'N'
                and     user_name =       '".$email."'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_user_id($newArray['user_id']);
            $this->set_user_name($newArray['user_name']);
            $this->set_user_password($newArray['user_password']);
            $this->set_user_archived($newArray['user_archived']);
        }

        $this->getAccessList();
    }

    public function loadByID($id) {
        $link = getConnection();
        $query = " select user_id,
                        user_name,
                        user_password,
                        user_archived
                from    core_user
                where   user_archived =   'N'
                and     user_id =  ".$id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_user_id($newArray['user_id']);
            $this->set_user_name($newArray['user_name']);
            $this->set_user_password($newArray['user_password']);
            $this->set_user_archived($newArray['user_archived']);
        }

        $this->getAccessList();
    }

    public function insert() {
        $link = getConnection();

        $query = "  INSERT
                    INTO   core_user
                           (
                                  user_name           ,
                                  user_password        ,
                                  user_archived
                           )
                           VALUES
                           (
                                  '".$this->get_user_name()."'           ,
                                  '".$this->get_user_password()."'        ,
                                  'N'
                           )";

        executeUpdateQuery($link , $query);

        $user_id = mysql_insert_id($link);
        $this->set_user_id($user_id);
        closeConnection($link);

    }

    public function updatePassword($new_password) {
        $link = getConnection();
        $newPassword = md5($new_password);
        $query = " UPDATE core_user
               SET    user_password = '".$newPassword."'
               WHERE  user_id = ".$this->get_user_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        //delete user account
        $link = getConnection();
        $query = " UPDATE core_user
                   SET    user_archived = 'Y'
                   WHERE  user_id = ".$this->get_user_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    private function getAccessList(){
        $this->accessModuleNameList = [];
        $this->accessModuleCodeList = [];
        $this->accessModuleIDList = [];
        $count =  0;
        $link = getConnection();

        $query = "  SELECT core_module.module_id,
                           core_module.module_name,
                           core_module.module_code
                    FROM core_user_module_access, core_module
                    WHERE core_user_module_access.module_id = core_module.module_id
                    AND core_user_module_access.user_id = ".$this->get_user_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $module = new Module();
            $module->set_module_id($newArray['module_id']);
            $module->set_module_name($newArray['module_name']);
            $module->set_module_code($newArray['module_code']);

            $this->accessModuleNameList[$count] = $newArray['module_name'];
            $this->accessModuleCodeList[$count] = $newArray['module_code'];
            $this->accessModuleIDList[$count] = $newArray['module_id'];
            ++$count;
        }
    }

    public function updateUserModuleAccess(){
        //$_user_id, $_module_id
        $link = getConnection();
        $query = "  INSERT INTO core_user_module_access ($_user_id, $_module_id)
                    VALUES(2, 1)
                    ON DUPLICATE KEY
                    UPDATE user_id=VALUES(user_id),
                           module_id=VALUES(module_id)";
        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function toJSON(){
        return  str_replace('\\u0000', "", json_encode( (array) $this ));
    }

}
?>
