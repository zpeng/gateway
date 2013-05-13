<?php
class LoveIt{
    public $deal_id;
    public $client_id;

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setDealId($deal_id)
    {
        $this->deal_id = $deal_id;
    }

    public function getDealId()
    {
        return $this->deal_id;
    }
}


?>