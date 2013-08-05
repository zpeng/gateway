<?php

namespace  modules\deal_steal\includes\classes;

class Concierge
{
    public $id;
    public $client_id;
    public $Client_name;
    public $supplier_id;
    public $supplier_name;
    public $request_detail;
    public $request_date;
    public $request_budget;
    public $status;
    public $timestamp;

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRequestBudget($request_budget)
    {
        $this->request_budget = $request_budget;
    }

    public function getRequestBudget()
    {
        return $this->request_budget;
    }

    public function setRequestDate($request_date)
    {
        $this->request_date = $request_date;
    }

    public function getRequestDate()
    {
        return $this->request_date;
    }

    public function setRequestDetail($request_detail)
    {
        $this->request_detail = $request_detail;
    }

    public function getRequestDetail()
    {
        return $this->request_detail;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setSupplierId($supplier_id)
    {
        $this->supplier_id = $supplier_id;
    }

    public function getSupplierId()
    {
        return $this->supplier_id;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setClientName($Client_name)
    {
        $this->Client_name = $Client_name;
    }

    public function getClientName()
    {
        return $this->Client_name;
    }

    public function setSupplierName($supplier_name)
    {
        $this->supplier_name = $supplier_name;
    }

    public function getSupplierName()
    {
        return $this->supplier_name;
    }

    public function loadById($id){
        $link = getConnection();
        $query = " SELECT
                      con_id,
                      ds_concierge.client_id,
                      CONCAT(ds_client.client_firstname , ' ', ds_client.client_surname) AS client_name,
                      ds_concierge.supplier_id,
                      ds_supplier.supplier_name,
                      request_detail,
                      request_date,
                      request_budget,
                      TIMESTAMP,
                      STATUS
                    FROM ds_concierge, ds_client, ds_supplier
                    WHERE ds_concierge.client_id = ds_client.client_id
                    AND ds_concierge.supplier_id = ds_supplier.supplier_id
                    AND con_id = ".$id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->setId($newArray['con_id']);
            $this->setClientId($newArray['client_id']);
            $this->setClientName($newArray['client_name']);
            $this->setSupplierId($newArray['supplier_id']);
            $this->setSupplierName($newArray['supplier_name']);
            $this->setRequestDetail($newArray['request_detail']);
            $this->setRequestDate($newArray['request_date']);
            $this->setRequestBudget($newArray['request_budget']);
            $this->setTimestamp($newArray['TIMESTAMP']);
            $this->setStatus($newArray['STATUS']);
        }

    }

    public function insert(){
        $link = getConnection();
        $query = " INSERT INTO ds_concierge
                   (  client_id,
                      supplier_id,
                      request_detail,
                      request_date,
                      request_budget,
                      TIMESTAMP,
                      STATUS)
                   VALUES ($this->getClientId(),
                   $this->getSupplierId(),
                   '".$this->getRequestDetail()."',
                   '".$this->getRequestDate()."',
                   '".$this->getRequestBudget()."',
                   NOW(),
                   'Pending')";

        executeUpdateQuery($link, $query);
        closeConnection($link);

    }

    public function updateStatus(){
        $link = getConnection();
        $query = " UPDATE ds_concierge
                   SET    STATUS = '".$this->getStatus()."'
                   WHERE  con_id = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }


}

?>