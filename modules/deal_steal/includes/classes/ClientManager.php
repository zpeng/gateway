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

    public function getClientListDataSource($archived='N'){
        $clientList = $this->loadAllClients($archived);
        $dataSource = array();
        $count = 0;
        if (sizeof($clientList) > 0) {
            foreach ($clientList as $client) {
                $dataSource[$count] = array(
                    "id" => $client->getClientId(),
                    "email" => $client->getClientEmail(),
                    "name" => $client->getClientFirstname() . " " . $client->getClientSurname(),
                    "tel" => $client->getClientTel(),
                    "mobile" => $client->getClientMobile(),
                    "action" => ""
                );
                ++$count;
            }
        }
        return $dataSource;
    }

    public function getClientTableDataSource($archived='N')
    {
        $clientList = $this->loadAllClients($archived);
        $header = array("ID", "Email", "Title", "Name", "Telephone", "Mobile", "Action");
        $body = [];
        if (sizeof($clientList) > 0) {
            foreach ($clientList as $client) {
                array_push($body, array(
                    $client->getClientId(),
                    $client->getClientEmail(),
                    $client->getClientTitle(),
                    $client->getClientFirstname() . " " . $client->getClientSurname(),
                    $client->getClientTel(),
                    $client->getClientMobile(),
                    "<a class='icon_edit' title='View Detail' href='" . SERVER_URL . "admin/main.php?view=client_detail&client_id=" .
                        $client->getClientId() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>"
                ));
            }
        }
        $dataSource = array(
            "header" => $header,
            "body" => $body
        );
        return $dataSource;
    }

}


?>