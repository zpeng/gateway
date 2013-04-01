<?php
class UserManager {
    //put your code here
    public function login($email, $password) {
        $link = getConnection();
        $loginResult = false;
        $password = md5($password);

        $query = " select user_id,
                        user_name,
                        user_password,
                        user_archived
                from    core_user
                where   user_archived =   'N'
                and     user_name =       '".$email."'
                and     user_password =   '".$password."'";



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

    public function getUserList() {
        $userList = [];
        $count =  0;
        $link = getConnection();

        $query="select 	user_id
                from    core_user
                where   user_archived =   'N'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $user = new User();
            $user->loadByID($newArray['user_id']);
            $userList[$count] = $user;
            ++$count;
        }
        return $userList;
    }

    public function getUserListAsJSON(){
        return  str_replace('\\u0000', "", json_encode( (array) $this->getUserList() ));
    }
}
?>
