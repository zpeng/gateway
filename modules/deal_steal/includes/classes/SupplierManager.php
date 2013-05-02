<?php
class SupplierManager
{
    public function loadAllSuppliers()
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
                              supplier_archived
                              FROM ds_supplier
                   WHERE    supplier_archived = 'N' ";

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
            $supplier->setSupplierArchived($newArray['supplier_archived']);
            array_push($supplier_list, $supplier);
        }
        return $supplier_list;
    }

    public function getSupplierTableDataSource($imageFolderPath)
    {
        $supplier_list = $this->loadAllSuppliers();
        $header = array("ID", "Name", "Logo", "Email", "Tel", "Action");
        $body = [];
        if (sizeof($supplier_list) > 0) {
            foreach ($supplier_list as $supplier) {
                array_push($body, array(
                    $supplier->getSupplierId(),
                    $supplier->getSupplierName(),
                    $supplier->outputLogoAsImage($imageFolderPath, "supplier_logo", 25, 25),
                    $supplier->getSupplierEmail(),
                    $supplier->getSupplierTel(),
                    "<a class='icon_delete' title='Delete this supplier' href='" . SERVER_URL . "modules/deal_steal/admin/control/supplier_delete.php?supplier_id=" .
                     $supplier->getSupplierId() . "&module_code=" . $_REQUEST['module_code'] . "'
                     onclick='return confirmDeletion()'></a>
                     <a class='icon_edit' title='Update supplier' href='" . SERVER_URL . "admin/main.php?view=supplier_update&supplier_id=" .
                     $supplier->getSupplierId() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>"
                ));
            }
        }
        $dataSource = array(
            "header" => $header,
            "body" => $body
        );
        return $dataSource;
    }
}

?>