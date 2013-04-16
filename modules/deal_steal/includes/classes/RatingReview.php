<?php
class RatingReview{
    public $deal_id;
    public $client_id;
    public $rating_value;
    public $review;
    public $timestamp;

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

    public function setRatingValue($rating_value)
    {
        $this->rating_value = $rating_value;
    }

    public function getRatingValue()
    {
        return $this->rating_value;
    }

    public function setReview($review)
    {
        $this->review = $review;
    }

    public function getReview()
    {
        return $this->review;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }



}


?>