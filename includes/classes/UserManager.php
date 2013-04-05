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

    public function getUserList()
    {
        $userList = [];
        $count = 0;
        $link = getConnection();

        $query = "select 	user_id
                from    core_user
                where   user_archived =   'N'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $user = new User();
            $user->loadByID($newArray['user_id']);
            $userList[$count] = $user;
            ++$count;
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
                                        <th>Accessible Modules</th>
                                        <th>Action</th>
                                    </tr>";

        $userList = $this->getUserList();
        if (sizeof($userList) > 0 ) {
            foreach($userList as $user) {
                $htmlTable = $htmlTable . "  <tr>
                        <td>".$user->get_user_id()."</td>
                        <td>".$user->get_user_name()."</td>
                        <td>".implode(", ",$user->accessModuleNameList)."</td>
                        <td>
                        <a href='process/admin_admin_delete_process.php?admin_id=".$user->get_user_id()."'
                        onclick='return confirmDeletion()'>".displayAdminDeleteIcon(15,15,'Delete this user account')."</a>
                        <a href='index.php?view=admin_admin_password_update&admin_id=".$user->get_user_id()."'
                        >".displayAdminEditIcon(15,15,'Update password')."</a>
                        </td>
                        </tr> ";
            }
        }
        $htmlTable = $htmlTable . "</table>";
        return $htmlTable;
    }
}
?>
