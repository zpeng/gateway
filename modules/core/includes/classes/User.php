<?php
namespace  modules\core\includes\classes;

class User
{
    public $user_id;
    public $user_name;
    public $user_password;
    public $active;
    public $user_subscribe_module_code_name_map = array();
    public $user_subscribe_module_code_list = array();

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

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

    public function loadByEmail($email)
    {
        $link = getConnection();

        $query = " select 	user_id,
                        user_name,
                        active
                from    core_user
                where   active =   'Y'
                and     user_name =       '" . $email . "'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_user_id($newArray['user_id']);
            $this->set_user_name($newArray['user_name']);
            $this->setActive($newArray['active']);
        }

        $this->getUserSubscribeModules();
    }

    public function loadByID($id)
    {
        $link = getConnection();
        $query = " select user_id,
                        user_name,
                        active
                from    core_user
                where   active =   'Y'
                and     user_id =  " . $id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_user_id($newArray['user_id']);
            $this->set_user_name($newArray['user_name']);
            $this->setActive($newArray['active']);
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
                                  user_password
                           )
                           VALUES
                           (
                                  '" . $this->get_user_name() . "'           ,
                                  '" . $this->get_user_password() . "'
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
                   SET    active = 'N'
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

        foreach ($this->user_subscribe_module_code_list as $module_code) {
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

        $this->user_subscribe_module_code_name_map = array();
        $this->user_subscribe_module_code_list = array();
        $link = getConnection();

        $query = "  SELECT core_module.module_name,
                           core_module.module_code
                    FROM core_user_subscribe_module, core_module
                    WHERE core_user_subscribe_module.module_code = core_module.module_code
                    AND core_user_subscribe_module.user_id = " . $this->get_user_id() . "
                    ORDER BY (CASE WHEN core_module.module_name='System Core' THEN 0 ELSE 1 END)";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->user_subscribe_module_code_name_map[$newArray['module_code']] = $newArray['module_name'];
            array_push($this->user_subscribe_module_code_list, $newArray['module_code']);
        }
    }

    public function getUserSubscribeModuleDataSource()
    {
        $moduleManager = new ModuleManager();
        $module_list = $moduleManager->getModuleList();
        $data = array();
        if (sizeof($module_list) > 0) {
            foreach ($module_list as $module) {
                $data[$module->get_module_name()] = $module->get_module_code();
            }
        }

        if (sizeof($this->user_subscribe_module_code_name_map) > 0) {
            foreach ($this->user_subscribe_module_code_name_map as $code => $name) {
                $selected[$name] = $code;
            }
        }
        $dataSource = array(
            "data" => $data,
            "selected" => $selected
        );
        return $dataSource;
    }

    public function toJSON()
    {
        return str_replace('\\u0000', "", json_encode((array)$this));
    }

}
?>
