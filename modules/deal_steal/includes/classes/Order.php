<?php
namespace  modules\deal_steal\includes\classes;

class Order{

    private $order_id;
    private $order_code;
    private $client_id;
    private $client_name;
    private $deal_id;
    private $deal_name;

    private $quantity;
    private $unit_price;
    private $total_price;
    private $payment_method;

    private $delivery_postcode;
    private $delivery_add_1;
    private $delivery_add_2;
    private $delivery_county;

    private $order_timestamp;
    private $order_status;

    static public function cast(Order $object) {
        return $object;
    }

    function __construct() {
        $this->setQuantity(0);
        $this->setUnitPrice(0.0);
        $this->setTotalPrice(0.0);
    }

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setClientName($client_name)
    {
        $this->client_name = $client_name;
    }

    public function getClientName()
    {
        return $this->client_name;
    }

    public function setDealId($deal_id)
    {
        $this->deal_id = $deal_id;
    }

    public function getDealId()
    {
        return $this->deal_id;
    }

    public function setDealName($deal_name)
    {
        $this->deal_name = $deal_name;
    }

    public function getDealName()
    {
        return $this->deal_name;
    }

    public function setDeliveryAdd1($delivery_add_1)
    {
        $this->delivery_add_1 = $delivery_add_1;
    }

    public function getDeliveryAdd1()
    {
        return $this->delivery_add_1;
    }

    public function setDeliveryAdd2($delivery_add_2)
    {
        $this->delivery_add_2 = $delivery_add_2;
    }

    public function getDeliveryAdd2()
    {
        return $this->delivery_add_2;
    }

    public function setDeliveryCounty($delivery_county)
    {
        $this->delivery_county = $delivery_county;
    }

    public function getDeliveryCounty()
    {
        return $this->delivery_county;
    }

    public function setDeliveryPostcode($delivery_postcode)
    {
        $this->delivery_postcode = $delivery_postcode;
    }

    public function getDeliveryPostcode()
    {
        return $this->delivery_postcode;
    }

    public function setOrderCode($order_code)
    {
        $this->order_code = $order_code;
    }

    public function getOrderCode()
    {
        return $this->order_code;
    }

    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function setOrderStatus($order_status)
    {
        $this->order_status = $order_status;
    }

    public function getOrderStatus()
    {
        return $this->order_status;
    }

    public function setOrderTimestamp($order_timestamp)
    {
        $this->order_timestamp = $order_timestamp;
    }

    public function getOrderTimestamp()
    {
        return $this->order_timestamp;
    }

    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;
    }

    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    public function loadByID($id)
    {
        $link = getConnection();
        $query = " SELECT
                      order_id,
                      order_code,
                      ds_client.client_id,
                      CONCAT(ds_client.client_firstname, ' ' , ds_client.client_surname) AS client_name,
                      ds_order.deal_id,
                      CONCAT(ds_supplier.supplier_name, ' - ', ds_deal.deal_title) AS deal_title,
                      unit_price,
                      total_price,
                      ds_order.quantity,
                      payment_method,
                      del_postcode,
                      del_add_1,
                      del_add_2,
                      del_county,
                      order_timestamp,
                      order_status
                    FROM ds_order, ds_client, ds_deal, ds_supplier
                    WHERE ds_client.client_id = ds_order.client_id
                    AND ds_deal.deal_id = ds_order.deal_id
                    AND ds_supplier.supplier_id = ds_deal.supplier_id
                    AND order_id  =  " . $id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->setOrderId($newArray['order_id']);
            $this->setOrderCode($newArray['order_code']);
            $this->setClientId($newArray['client_id']);
            $this->setClientName($newArray['client_name']);
            $this->setDealId($newArray['deal_id']);
            $this->setDealName($newArray['deal_title']);
            $this->setUnitPrice($newArray['unit_price']);
            $this->setTotalPrice($newArray['total_price']);
            $this->setQuantity($newArray['quantity']);
            $this->setPaymentMethod($newArray['payment_method']);
            $this->setDeliveryPostcode($newArray['del_postcode']);
            $this->setDeliveryAdd1($newArray['del_add_1']);
            $this->setDeliveryAdd2($newArray['del_add_2']);
            $this->setDeliveryCounty($newArray['del_county']);
            $this->setOrderTimestamp($newArray['order_timestamp']);
            $this->setOrderStatus($newArray['order_status']);
        }
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_order
                                (order_code,
                                 client_id,
                                 deal_id,
                                 unit_price,
                                 total_price,
                                 quantity,
                                 payment_method,
                                 del_postcode,
                                 del_add_1,
                                 del_add_2,
                                 del_county,
                                 order_timestamp,
                                 order_status)
                    VALUES ('".$this->getOrderCode()."',
                            ".$this->getClientId().",
                            ".$this->getDealId().",
                            ".$this->getUnitPrice().",
                            ".$this->getTotalPrice().",
                            ".$this->getQuantity().",
                            '".$this->getPaymentMethod()."',
                            '".$this->getDeliveryPostcode()."',
                            '".$this->getDeliveryAdd1()."',
                            '".$this->getDeliveryAdd2()."',
                            '".$this->getDeliveryCounty()."',
                            NOW(),
                            '".$this->getOrderStatus()."')";

        executeUpdateQuery($link, $query);
        $last_insert_id = mysql_insert_id();
        closeConnection($link);
        return $last_insert_id;
    }

    public function updateOrderStatus(){
        $link = getConnection();
        $query = " UPDATE  ds_order
                   SET     order_status = '" . $this->getOrderStatus() . "'
                   WHERE   order_id = " . $this->getOrderId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

}