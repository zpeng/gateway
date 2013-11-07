<?php
namespace  modules\deal_steal\includes\classes;

class NewsletterSubscribeManager
{
    public function loadAllEmails()
    {
        $emailList = array();
        $link = getConnection();
        $query = "select 	email
                    from    ds_newsletter_subscriber ";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            array_push($emailList, $newArray['email']);
        }
        return $emailList;
    }

    public function unsubscribe($email){
        $email = secureRequestParameter($email);
        $link = getConnection();
        $query = "DELETE FROM ds_newsletter_subscriber WHERE email = '".$email."'";
        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function subscribe($email){
        $email = secureRequestParameter($email);
        $link = getConnection();

        $query1 = "DELETE FROM ds_newsletter_subscriber WHERE email = '".$email."'";
        executeUpdateQuery($link, $query1);

        $query2 = "INSERT INTO ds_newsletter_subscriber (email) VALUES ('".$email."')";
        executeUpdateQuery($link, $query2);
        closeConnection($link);
    }
}


?>