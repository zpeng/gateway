<?php
class Supplier{
    public $supplier_id;
    public $supplier_name;
    public $supplier_url;
    public $supplier_logo;
    public $supplier_email;
    public $supplier_address;
    public $supplier_tel;
    public $supplier_desc;
    public $supplier_archived;

    public function setSupplierAddress($supplier_address)
    {
        $this->supplier_address = $supplier_address;
    }

    public function getSupplierAddress()
    {
        return $this->supplier_address;
    }

    public function setSupplierArchived($supplier_archived)
    {
        $this->supplier_archived = $supplier_archived;
    }

    public function getSupplierArchived()
    {
        return $this->supplier_archived;
    }

    public function setSupplierDesc($supplier_desc)
    {
        $this->supplier_desc = $supplier_desc;
    }

    public function getSupplierDesc()
    {
        return $this->supplier_desc;
    }

    public function setSupplierEmail($supplier_email)
    {
        $this->supplier_email = $supplier_email;
    }

    public function getSupplierEmail()
    {
        return $this->supplier_email;
    }

    public function setSupplierId($supplier_id)
    {
        $this->supplier_id = $supplier_id;
    }

    public function getSupplierId()
    {
        return $this->supplier_id;
    }

    public function setSupplierLogo($supplier_logo)
    {
        $this->supplier_logo = $supplier_logo;
    }

    public function getSupplierLogo()
    {
        return $this->supplier_logo;
    }

    public function setSupplierName($supplier_name)
    {
        $this->supplier_name = $supplier_name;
    }

    public function getSupplierName()
    {
        return $this->supplier_name;
    }

    public function setSupplierTel($supplier_tel)
    {
        $this->supplier_tel = $supplier_tel;
    }

    public function getSupplierTel()
    {
        return $this->supplier_tel;
    }

    public function setSupplierUrl($supplier_url)
    {
        $this->supplier_url = $supplier_url;
    }

    public function getSupplierUrl()
    {
        return $this->supplier_url;
    }

}


?>