<?php
class LoveHate{
    public $deal_id;
    public $client_id;
    public $love_it;

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

    public function setLoveIt($love_it)
    {
        $this->love_it = $love_it;
    }

    public function getLoveIt()
    {
        return $this->love_it;
    }



}


?>