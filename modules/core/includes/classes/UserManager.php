<?php
class UserManager
{
    //put your code here
    public function login($email, $password)
    {
        $link = getConnection();
        $loginResult = false;
        $password = md5($password);

        $query = " select user_id,
                        user_name,
                        user_password,
                        user_archived
                from    core_user
                where   user_archived =   'N'
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
                where   user_archived =   'N'
                and     user_name =  '" . $email."'";

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
        $userList = [];
        $link = getConnection();

        $query = "select 	user_id
                from    core_user
                where   user_archived =   'N'";

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

    public function outputAsHtmlTable($id = "", $class = "")
    {
        $htmlTable = "<table id='$id' class='$class'>";
        $htmlTable = $htmlTable . "<tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Subscribed Modules</th>
                                        <th>Action</th>
                                    </tr>";

        $userList = $this->getUserList();
        if (sizeof($userList) > 0) {
            foreach ($userList as $user) {
                $htmlTable = $htmlTable . "  <tr>
                        <td>" . $user->get_user_id() . "</td>
                        <td>" . $user->get_user_name() . "</td>
                        <td>" . implode(", ", array_values($user->user_subscribe_module_code_name_map)) . "</td>
                        <td>
                        <a class='icon_delete' title='Delete this user account' href='" . SERVER_URL . "admin/control/user_delete_process.php?user_id=" .
                    $user->get_user_id() . "&module_code=" . $_REQUEST['module_code'] . "'
                        onclick='return confirmDeletion()'></a>
                        <a class='icon_edit' title='Update password' href='" . SERVER_URL . "admin/main.php?view=user_password_update&user_id=" .
                    $user->get_user_id() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>
                       <a class='icon_admin' title='Update module subscription' href='" . SERVER_URL . "admin/main.php?view=user_module_update&user_id=" .
                    $user->get_user_id() . "&module_code=" . $_REQUEST['module_code'] . "' ></
                        </td>
                        </tr> ";
            }
        }
        $htmlTable = $htmlTable . "</table>";
        return $htmlTable;
    }
}
?>
