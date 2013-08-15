<?php
namespace  modules\deal_steal\includes\classes;


class Supplier{
    public $supplier_id;
    public $supplier_name;
    public $supplier_url;
    public $supplier_logo;
    public $supplier_email;
    public $supplier_address;
    public $supplier_tel;
    public $supplier_desc;
    public $active;

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setSupplierAddress($supplier_address)
    {
        $this->supplier_address = $supplier_address;
    }

    public function getSupplierAddress()
    {
        return $this->supplier_address;
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

    public function loadByID($id)
    {
        $link = getConnection();
        $query = " SELECT
                              supplier_id,
                              supplier_name,
                              supplier_url,
                              supplier_logo,
                              supplier_email,
                              supplier_address,
                              supplier_tel,
                              supplier_desc,
                              active
                              FROM ds_supplier
                   WHERE    supplier_id =  ".$id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->setSupplierId($newArray['supplier_id']);
            $this->setSupplierName($newArray['supplier_name']);
            $this->setSupplierUrl($newArray['supplier_url']);
            $this->setSupplierLogo($newArray['supplier_logo']);
            $this->setSupplierEmail($newArray['supplier_email']);
            $this->setSupplierAddress($newArray['supplier_address']);
            $this->setSupplierTel($newArray['supplier_tel']);
            $this->setSupplierDesc($newArray['supplier_desc']);
            $this->setActive($newArray['active']);
        }
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_supplier
                   ( supplier_name,
                     supplier_url,
                     supplier_logo,
                     supplier_email,
                     supplier_address,
                     supplier_tel,
                     supplier_desc)
                   VALUES ('".$this->getSupplierName()."',
                   '".$this->getSupplierUrl()."',
                   '".$this->getSupplierLogo()."',
                   '".$this->getSupplierEmail()."',
                   '".$this->getSupplierAddress()."',
                   '".$this->getSupplierTel()."',
                   '".$this->getSupplierDesc()."')";

        executeUpdateQuery($link, $query);
        $last_insert_id = mysql_insert_id();
        closeConnection($link);
        return $last_insert_id;
    }

    public function update(){
        $link = getConnection();
        $query = " UPDATE  ds_supplier
                   SET     supplier_name = '".$this->getSupplierName()."',
                           supplier_url = '".$this->getSupplierUrl()."',
                           supplier_logo = '".$this->getSupplierLogo()."',
                           supplier_email = '".$this->getSupplierEmail()."',
                           supplier_address = '".$this->getSupplierAddress()."',
                           supplier_tel = '".$this->getSupplierTel()."',
                           supplier_desc = '".$this->getSupplierDesc()."'
                   WHERE   supplier_id = " . $this->getSupplierId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function updateStatus(){
        $link = getConnection();
        $query = " UPDATE  ds_supplier
                   SET     active = '".$this->getActive()."'
                   WHERE   supplier_id = " . $this->getSupplierId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function outputLogoAsImage($imageFolderPath, $class, $width, $height, $border=0 ) {
        return "<img border='$border' width='$width' height='$height' class='$class' src='".$imageFolderPath.$this->getSupplierLogo()."' />";
    }
}


?>