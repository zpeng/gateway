<?php
namespace modules\deal_steal\includes\classes;


class Client
{
    public $client_id;
    public $client_email;
    public $client_password;
    public $client_title;
    public $client_firstname;
    public $client_surname;
    public $client_dob;
    public $client_tel;
    public $client_mobile;
    public $subscribed;
    public $client_archived;

    public function setSubscribed($subscribed)
    {
        $this->subscribed = $subscribed;
    }

    public function getSubscribed()
    {
        return $this->subscribed;
    }

    public function setClientTitle($client_title)
    {
        $this->client_title = $client_title;
    }

    public function getClientTitle()
    {
        return $this->client_title;
    }

    public function setClientDob($client_dob)
    {
        $this->client_dob = $client_dob;
    }

    public function getClientDob()
    {
        return $this->client_dob;
    }

    public function setClientEmail($client_email)
    {
        $this->client_email = $client_email;
    }

    public function getClientEmail()
    {
        return $this->client_email;
    }

    public function setClientFirstname($client_firstname)
    {
        $this->client_firstname = $client_firstname;
    }

    public function getClientFirstname()
    {
        return $this->client_firstname;
    }

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setClientMobile($client_mobile)
    {
        $this->client_mobile = $client_mobile;
    }

    public function getClientMobile()
    {
        return $this->client_mobile;
    }

    public function setClientPassword($client_password)
    {
        $this->client_password = $client_password;
    }

    public function getClientPassword()
    {
        return $this->client_password;
    }

    public function setClientSurname($client_surname)
    {
        $this->client_surname = $client_surname;
    }

    public function getClientSurname()
    {
        return $this->client_surname;
    }

    public function setClientTel($client_tel)
    {
        $this->client_tel = $client_tel;
    }

    public function getClientTel()
    {
        return $this->client_tel;
    }

    public function setClientArchived($client_archived)
    {
        $this->client_archived = $client_archived;
    }

    public function getClientArchived()
    {
        return $this->client_archived;
    }

    public function loadByID($id)
    {
        $link = getConnection();
        $query = " SELECT     client_id,
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
                   WHERE      client_id =  " . $id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->setClientId($newArray['client_id']);
            $this->setClientEmail($newArray['client_email']);
            $this->setClientPassword($newArray['client_password']);
            $this->setClientTitle($newArray['client_title']);
            $this->setClientFirstname($newArray['client_firstname']);
            $this->setClientSurname($newArray['client_surname']);
            $this->setClientDob($newArray['client_dob']);
            $this->setClientTel($newArray['client_tel']);
            $this->setClientMobile($newArray['client_mobile']);
            $this->setSubscribed($newArray['subscribed']);
            $this->setClientArchived($newArray['client_archived']);
        }
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_client
                   (  client_email,
                      client_password,
                      client_title,
                      client_firstname,
                      client_surname,
                      client_dob,
                      client_tel,
                      client_mobile,
                      subscribed,
                      client_archived)
                   VALUES ('" . $this->getClientEmail() . "',
                   '" . $this->getClientPassword() . "',
                   '" . $this->getClientTitle() . "',
                   '" . $this->getClientFirstname() . "',
                   '" . $this->getClientSurname() . "',
                   '" . $this->getClientDob() . "',
                   '" . $this->getClientTel() . "',
                   '" . $this->getClientMobile() . "',
                   '" . $this->getSubscribed() . "',
                   'N')";

        executeUpdateQuery($link, $query);
        $last_insert_id = mysql_insert_id();
        closeConnection($link);
        return $last_insert_id;
    }

    public function update()
    {
        $link = getConnection();
        $query = " UPDATE  ds_client
                   SET     client_title = '" . $this->getClientTitle() . "',
                           client_firstname = '" . $this->getClientFirstname() . "',
                           client_surname = '" . $this->getClientSurname() . "',
                           client_dob = '" . $this->getClientDob() . "',
                           client_tel = '" . $this->getClientTel() . "',
                           client_mobile = '" . $this->getClientMobile() . "',
                           subscribed = '" . $this->getSubscribed() . "'
                   WHERE   client_id = " . $this->getClientId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function updateStatus()
    {
        $link = getConnection();
        $query = " UPDATE  ds_client
                   SET     client_archived = '" . $this->getClientArchived() . "'
                   WHERE   client_id = " . $this->getClientId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function updatePassword($new_password)
    {
        $link = getConnection();
        $newPassword = md5($new_password);
        $query = " UPDATE ds_client
                   SET    client_password = '" . $newPassword . "'
                   WHERE  client_id = " . $this->getClientId();

        $result = executeUpdateQuery($link, $query);
        closeConnection($link);
        return $result;
    }

}

?>