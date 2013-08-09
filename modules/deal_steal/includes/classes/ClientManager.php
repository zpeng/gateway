<?php
namespace  modules\deal_steal\includes\classes;

class ClientManager
{
    public function loadAllClients($archived='N')
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
                              client_archived
                   FROM       ds_client
                   WHERE      client_archived = '".$archived."'";
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
            $client->setClientArchived($newArray['client_archived']);
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