<?php
class ClientManager
{
    public function loadAllClients(){
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
                              client_mobile
                   FROM       ds_client";
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
            array_push($clientList, $client);
        }
        return $clientList;
    }

    public function outputClientsAsHtmlTable($id = "", $class = "")
    {
        $htmlTable = "<table id='$id' class='$class'>";
        $htmlTable = $htmlTable . "<tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Telephone</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                    </tr>";

        $client_list = $this->loadAllClients();

        if (sizeof($client_list) > 0) {
            foreach ($client_list as $client) {

                $htmlTable = $htmlTable . " <tr>
                                <td>" . $client->getClientId() . "</td>
                                <td>" . $client->getClientEmail() . "</td>
                                <td>" . $client->getClientTitle() . "</td>
                                <td>" . $client->getClientFirstname()." ".$client->getClientSurname() . "</td>
                                <td>" . $client->getClientTel() . "</td>
                                <td>" . $client->getClientMobile() . "</td>
                                <td>
                                <a class='icon_edit' title='Update City' href='" . SERVER_URL . "admin/main.php?view=client_detail&client_id=" .
                    $client->getClientId() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>
                                </td>
                                </tr> ";
            }
        }
        $htmlTable = $htmlTable . "</table>";
        return $htmlTable;
    }
}


?>