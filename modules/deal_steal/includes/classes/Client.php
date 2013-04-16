<?php
class Client{
    public $client_id;
    public $client_email;
    public $client_password;
    public $client_title;
    public $client_firstname;
    public $client_surname;
    public $client_dob;
    public $client_tel;
    public $client_mobile;
    public $client_address;

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

    public function setClientAddress($client_address)
    {
        $this->client_address = $client_address;
    }

    public function getClientAddress()
    {
        return $this->client_address;
    }


}

?>