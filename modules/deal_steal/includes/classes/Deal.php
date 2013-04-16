<?php
class Deal
{
    public $deal_id;
    public $deal_supplier_id;
    public $deal_category_id;
    public $deal_title;
    public $deal_type;
    public $deal_desc;
    public $deal_quantity;
    public $deal_original_price;
    public $deal_offer_price;
    public $deal_online_date;
    public $deal_offline_date;
    public $deal_fine_print;
    public $deal_archived;

    public function setDealArchived($deal_archived)
    {
        $this->deal_archived = $deal_archived;
    }

    public function getDealArchived()
    {
        return $this->deal_archived;
    }

    public function setDealCategoryId($deal_category_id)
    {
        $this->deal_category_id = $deal_category_id;
    }

    public function getDealCategoryId()
    {
        return $this->deal_category_id;
    }

    public function setDealDesc($deal_desc)
    {
        $this->deal_desc = $deal_desc;
    }

    public function getDealDesc()
    {
        return $this->deal_desc;
    }

    public function setDealFinePrint($deal_fine_print)
    {
        $this->deal_fine_print = $deal_fine_print;
    }

    public function getDealFinePrint()
    {
        return $this->deal_fine_print;
    }

    public function setDealId($deal_id)
    {
        $this->deal_id = $deal_id;
    }

    public function getDealId()
    {
        return $this->deal_id;
    }

    public function setDealOfferPrice($deal_offer_price)
    {
        $this->deal_offer_price = $deal_offer_price;
    }

    public function getDealOfferPrice()
    {
        return $this->deal_offer_price;
    }

    public function setDealOfflineDate($deal_offline_date)
    {
        $this->deal_offline_date = $deal_offline_date;
    }

    public function getDealOfflineDate()
    {
        return $this->deal_offline_date;
    }

    public function setDealOnlineDate($deal_online_date)
    {
        $this->deal_online_date = $deal_online_date;
    }

    public function getDealOnlineDate()
    {
        return $this->deal_online_date;
    }

    public function setDealOriginalPrice($deal_original_price)
    {
        $this->deal_original_price = $deal_original_price;
    }

    public function getDealOriginalPrice()
    {
        return $this->deal_original_price;
    }

    public function setDealQuantity($deal_quantity)
    {
        $this->deal_quantity = $deal_quantity;
    }

    public function getDealQuantity()
    {
        return $this->deal_quantity;
    }

    public function setDealSupplierId($deal_supplier_id)
    {
        $this->deal_supplier_id = $deal_supplier_id;
    }

    public function getDealSupplierId()
    {
        return $this->deal_supplier_id;
    }

    public function setDealTitle($deal_title)
    {
        $this->deal_title = $deal_title;
    }

    public function getDealTitle()
    {
        return $this->deal_title;
    }

    public function setDealType($deal_type)
    {
        $this->deal_type = $deal_type;
    }

    public function getDealType()
    {
        return $this->deal_type;
    }



    public function getSupplier(){

    }

    public function getCategory(){

    }


}
?>