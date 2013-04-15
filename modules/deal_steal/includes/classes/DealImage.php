<?php
class DealImage{
    public $deal_image_id;
    public $deal_id;
    public $deal_image_title;
    public $deal_image_url;
    public $deal_image_is_default;

    public function setDealId($deal_id)
    {
        $this->deal_id = $deal_id;
    }

    public function getDealId()
    {
        return $this->deal_id;
    }

    public function setDealImageId($deal_image_id)
    {
        $this->deal_image_id = $deal_image_id;
    }

    public function getDealImageId()
    {
        return $this->deal_image_id;
    }

    public function setDealImageIsDefault($deal_image_is_default)
    {
        $this->deal_image_is_default = $deal_image_is_default;
    }

    public function getDealImageIsDefault()
    {
        return $this->deal_image_is_default;
    }

    public function setDealImageTitle($deal_image_title)
    {
        $this->deal_image_title = $deal_image_title;
    }

    public function getDealImageTitle()
    {
        return $this->deal_image_title;
    }

    public function setDealImageUrl($deal_image_url)
    {
        $this->deal_image_url = $deal_image_url;
    }

    public function getDealImageUrl()
    {
        return $this->deal_image_url;
    }



}