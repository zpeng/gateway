<?php
class User
{
    public $user_id;
    public $user_name;
    public $user_password;
    public $user_archived;
    public $user_subscribe_module_code_name_map = [];
    public $user_subscribe_module_code_list = [];


    public function get_user_id()
    {
        return $this->user_id;
    }

    public function set_user_id($_user_id)
    {
        $this->user_id = $_user_id;
    }

    public function get_user_name()
    {
        return $this->user_name;
    }

    public function set_user_name($_user_name)
    {
        $this->user_name = $_user_name;
    }

    public function get_user_password()
    {
        return $this->user_password;
    }

    public function set_user_password($_user_password)
    {
        $this->user_password = $_user_password;
    }

    public function get_user_archived()
    {
        return $this->user_archived;
    }

    public function set_user_archived($_user_archived)
    {
        $this->user_archived = $_user_archived;
    }

    public function loadByEmail($email)
    {
        $link = getConnection();

        $query = " select 	user_id,
                        user_name,
                        user_archived
                from    core_user
                where   user_archived =   'N'
                and     user_name =       '" . $email . "'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_user_id($newArray['user_id']);
            $this->set_user_name($newArray['user_name']);
            $this->set_user_archived($newArray['user_archived']);
        }

        $this->getUserSubscribeModules();
    }

    public function loadByID($id)
    {
        $link = getConnection();
        $query = " select user_id,
                        user_name,
                        user_archived
                from    core_user
                where   user_archived =   'N'
                and     user_id =  " . $id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_user_id($newArray['user_id']);
            $this->set_user_name($newArray['user_name']);
            $this->set_user_archived($newArray['user_archived']);
        }

        $this->getUserSubscribeModules();
    }

    public function insert()
    {
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
                                  '" . $this->get_user_name() . "'           ,
                                  '" . $this->get_user_password() . "'        ,
                                  'N'
                           )";

        executeUpdateQuery($link, $query);

        $user_id = mysql_insert_id($link);
        $this->set_user_id($user_id);
        closeConnection($link);

    }

    public function updatePassword($new_password)
    {
        $link = getConnection();
        $newPassword = md5($new_password);
        $query = " UPDATE core_user
               SET    user_password = '" . $newPassword . "'
               WHERE  user_id = " . $this->get_user_id();

        $result = executeUpdateQuery($link, $query);
        closeConnection($link);
        return $result;
    }

    public function delete()
    {
        //delete user account
        $link = getConnection();
        $query = " UPDATE core_user
                   SET    user_archived = 'Y'
                   WHERE  user_id = " . $this->get_user_id();
        executeUpdateQuery($link, $query);

        //delete user module access
        $query1 = " DELETE
                    FROM  core_user_subscribe_module
                    WHERE user_id = " . $this->get_user_id();

        executeUpdateQuery($link, $query1);

        closeConnection($link);
    }

    public function updateUserSubscribeModuleList()
    {
        //delete all user module subscription
        $link = getConnection();
        $query1 = " DELETE
                    FROM  core_user_subscribe_module
                    WHERE user_id = " . $this->get_user_id();

        executeUpdateQuery($link, $query1);

        foreach ($this->user_subscribe_module_code_list as $module_code ) {
            $query2 = " INSERT INTO core_user_subscribe_module
                        (user_id,  module_code)
                        VALUES (
                        " . $this->get_user_id() . ",'" .
                $module_code . "')";
            executeUpdateQuery($link, $query2);
        }
        closeConnection($link);
    }

    private function getUserSubscribeModules()
    {

        $this->user_subscribe_module_code_name_map = [];
        $this->user_subscribe_module_code_list = [];
        $count = 0;
        $link = getConnection();

        $query = "  SELECT core_module.module_name,
                           core_module.module_code
                    FROM core_user_subscribe_module, core_module
                    WHERE core_user_subscribe_module.module_code = core_module.module_code
                    AND core_user_subscribe_module.user_id = " . $this->get_user_id()."
                    ORDER BY (CASE WHEN core_module.module_name='System Core' THEN 0 ELSE 1 END)";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->user_subscribe_module_code_name_map[$newArray['module_code']] = $newArray['module_name'];
            $this->user_subscribe_module_code_list[$count] = $newArray['module_code'];
            ++$count;
        }
    }

    public function outputUserSubscribeModuleAsHtmlCheckboxList()
    {
        $html = "<ul class='checkbox_list'>";
        $moduleManager = new ModuleManager();
        if (sizeof($moduleManager->getModuleList()) > 0) {
            foreach ($moduleManager->getModuleList() as $module) {
                if (array_key_exists($module->get_module_code(), $this->user_subscribe_module_code_name_map)) {
                    $html = $html . "<li><input  checked='true' type='checkbox' name='subscribe_module_code_list[]' value='" . $module->get_module_code() . "'><label>" . $module->get_module_name() . "</label>";
                } else {
                    $html = $html . "<li><input type='checkbox' name='subscribe_module_code_list[]' value='" . $module->get_module_code() . "'><label>" . $module->get_module_name() . "</label>";
                }
            }
        }
        return $html = $html . "</ul>";
    }

    public function toJSON()
    {
        return str_replace('\\u0000', "", json_encode((array)$this));
    }

}
?>
