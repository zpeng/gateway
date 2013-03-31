<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of AdministratorManager
 *
 * @author ziyang
 */
class AdministratorManager {
    //put your code here
    public function adminLogin($email, $password) {
        $link = getConnection();
        $loginResult = false;
        $password = md5($password);

        $query = " select admin_id,
                        admin_name,
                        admin_password,
                        admin_archived
                from    core_admin
                where   admin_archived =   'N'
                and     admin_name =       '".$email."'
                and     admin_password =   '".$password."'";



        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        $num_rows = mysql_num_rows($result); // Find no. of rows retrieved from DB

        if ( $num_rows == 1 ) {
            $loginResult = true; // login successful
        }else {
            $loginResult = false; // login failure
        }
        return $loginResult;
    }

    public function getAdminList() {
        $adminList = [];
        $count =  0;
        $link = getConnection();

        $query="    select 	admin_id,
                        admin_name,
                        admin_password,
                        admin_archived
                from    core_admin
                where   admin_archived =   'N'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $admin = new Administrator();
            $admin->set_admin_id($newArray['admin_id']);
            $admin->set_admin_name($newArray['admin_name']);
            $admin->set_admin_archived($newArray['admin_archived']);

            $adminList[$count] = $admin;
            ++$count;
        }
        return $adminList;
    }

    public function getAdminListAsJSON(){
        return  str_replace('\\u0000', "", json_encode( (array) $this->getAdminList() ));
    }
}
?>
