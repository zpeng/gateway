<?php
namespace  modules\deal_steal\includes\classes;

class ClientManager
{
    //put your code here
    public function login($email, $password)
    {
        $link = getConnection();
        $loginResult = false;
        $password = md5($password);

        $query = " select client_id,
                        client_email,
                        client_password,
                        active
                from    ds_client
                where   active =   'Y'
                and     client_email =       '" . $email . "'
                and     client_password =   '" . $password . "'";


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

    public function checkClientExistsByEmail($email)
    {
        $link = getConnection();
        $check_result = false;
        $query = " select client_id
                from    ds_client
                where   active =   'Y'
                and     client_email =  '" . $email . "'";

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

    public function loadAllClients($active='Y')
    {
        $clientList = array();
        $link = getConnection();
        $query = "SELECT      client_id,
                              client_email,
                              client_password,
                              client_title,
                              client_firstname,
                              client_surname,
                              client_dob,
                              client_tel,
                              client_mobile,
                              subscribed,
                              active
                   FROM       ds_client
                   WHERE      active = '".$active."'";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $client = new Client();
            $client->setClientId($newArray['client_id']);
            $client->setClientEmail($newArray['client_email']);
            $client->setClientPassword($newArray['client_password']);
            $client->setClientTitle($newArray['client_title']);
            $client->setClientFirstname($newArray['client_firstname']);
            $client->setClientSurname($newArray['client_surname']);
            $client->setClientDob($newArray['client_dob']);
            $client->setClientTel($newArray['client_tel']);
            $client->setClientMobile($newArray['client_mobile']);
            $client->setActive($newArray['active']);
            array_push($clientList, $client);
        }
        return $clientList;
    }

    public function getClientTableDataSource($archived='N'){
        $clientList = $this->loadAllClients($archived);
        $dataSource = array();
        if (sizeof($clientList) > 0) {
            foreach ($clientList as $client) {
                array_push($dataSource, array(
                    "id" => $client->getClientId(),
                    "email" => $client->getClientEmail(),
                    "name" => $client->getClientFirstname() . " " . $client->getClientSurname(),
                    "tel" => $client->getClientTel(),
                    "mobile" => $client->getClientMobile(),
                    "action" => ""
                ));
            }
        }
        return $dataSource;
    }
}

?>