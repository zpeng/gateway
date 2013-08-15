<?php
namespace  modules\deal_steal\includes\classes;


class SupplierManager
{
    public function loadAllSuppliers($active='Y')
    {
        $supplier_list = [];
        $link = getConnection();
        $query = " SELECT     supplier_id,
                              supplier_name,
                              supplier_url,
                              supplier_logo,
                              supplier_email,
                              supplier_address,
                              supplier_tel,
                              supplier_desc,
                              active
                              FROM ds_supplier
                   WHERE    active = '".$active."' ";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $supplier = new Supplier();
            $supplier->setSupplierId($newArray['supplier_id']);
            $supplier->setSupplierName($newArray['supplier_name']);
            $supplier->setSupplierUrl($newArray['supplier_url']);
            $supplier->setSupplierLogo($newArray['supplier_logo']);
            $supplier->setSupplierEmail($newArray['supplier_email']);
            $supplier->setSupplierAddress($newArray['supplier_address']);
            $supplier->setSupplierTel($newArray['supplier_tel']);
            $supplier->setSupplierDesc($newArray['supplier_desc']);
            $supplier->setActive($newArray['active']);
            array_push($supplier_list, $supplier);
        }
        return $supplier_list;
    }

    public function getSupplierTableDataSource($is_archived = 'N')
    {
        $supplier_list = $this->loadAllSuppliers($is_archived);
        $dataSource = array();
        if (sizeof($supplier_list) > 0) {
            foreach ($supplier_list as $supplier) {
                array_push($dataSource, array(
                    "id" => $supplier->getSupplierId(),
                    "name" => $supplier->getSupplierName(),
                    "logo" => $supplier->getSupplierLogo(),
                    "action" => ""
                ));
            }
        }
        return $dataSource;
    }

    public function getSupplierDropdownDataSource($is_archived = 'N')
    {
        $supplier_list = $this->loadAllSuppliers($is_archived);
        $dataSource = array();
        $data = array();
        if (sizeof($supplier_list) > 0) {
            foreach ($supplier_list as $supplier) {
                array_push($data, array(
                    "id" => $supplier->getSupplierId(),
                    "name" => $supplier->getSupplierName()
                ));
            }
        }
        $dataSource = array(
            "data" => $data,
            "selected_value" => ""
        );
        return $dataSource;
    }

    public function getSupplierListDataSource()
    {
        $supplier_list = $this->loadAllSuppliers();
        $data = array();
        if (sizeof($supplier_list) > 0) {
            foreach ($supplier_list as $supplier) {
                $data[$supplier->getSupplierName()] = $supplier->getSupplierId();
            }
        }
        $dataSource = array(
            "data" => $data
        );
        return $dataSource;
    }

}

?>