<?php
namespace  modules\core\includes\classes;

class UserManager
{
    //put your code here
    public function login($email, $password)
    {
        $link = getConnection();
        $loginResult = false;
        $password = sha1($password);

        $query = " select user_id,
                        user_name,
                        user_password,
                        active
                from    core_user
                where   active =   'Y'
                and     user_name =       '" . $email . "'
                and     user_password =   '" . $password . "'";


        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        $num_rows = mysql_num_rows($result); // Find no. of rows retrieved from DB

        if ($num_rows == 1) {
            $loginResult = true; // login successful
        } else {
            $loginResult = false; // login failure
        }
        return $loginResult;
    }

    public function checkUserExistsByEmail($email)
    {
        $link = getConnection();
        $check_result = false;
        $query = " select user_id
                from    core_user
                where   active =   'Y'
                and     user_name =  '" . $email . "'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        $num_rows = mysql_num_rows($result); // Find no. of rows retrieved from DB

        if ($num_rows == 1) {
            $check_result = true; // login successful
        } else {
            $check_result = false; // login failure
        }
        return $check_result;
    }

    public function getUserList()
    {
        $userList = array();
        $link = getConnection();

        $query = "select 	user_id
                from    core_user
                where   active =   'Y'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $user = new User();
            $user->loadByID($newArray['user_id']);
            array_push($userList, $user);
        }
        return $userList;
    }

    public function getUserListAsJSON()
    {
        return str_replace('\\u0000', "", json_encode((array)$this->getUserList()));
    }

    public function getUserTableDataSource()
    {
        $userList = $this->getUserList();
        $dataSource = array();
        if (sizeof($userList) > 0) {
            foreach ($userList as $user) {
                array_push($dataSource, array(
                    "id" => $user->get_user_id(),
                    "name" => $user->get_user_name(),
                    "modules" => implode(", ", array_values($user->user_subscribe_module_code_name_map)),
                    "action" => ""
                ));
            }
        }
        return $dataSource;
    }
}
?>
