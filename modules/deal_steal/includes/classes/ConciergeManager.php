<?php
namespace modules\deal_steal\includes\classes;

class ConciergeManager
{
    public function loadConciergeList($status = "Pending")
    {
        $concierge_list = array();
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
                    AND STATUS = '".$status."'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $concierge = new Concierge();
            $concierge->setId($newArray['con_id']);
            $concierge->setClientId($newArray['client_id']);
            $concierge->setClientName($newArray['client_name']);
            $concierge->setSupplierId($newArray['supplier_id']);
            $concierge->setSupplierName($newArray['supplier_name']);
            $concierge->setRequestDetail($newArray['request_detail']);
            $concierge->setRequestDate($newArray['request_date']);
            $concierge->setRequestBudget($newArray['request_budget']);
            $concierge->setTimestamp($newArray['TIMESTAMP']);
            $concierge->setStatus($newArray['STATUS']);
            array_push($concierge_list, $concierge);
        }
        return $concierge_list;
    }

    public function getConciergeListDataSource($status = "Pending")
    {
        $concierge_list = $this->loadConciergeList($status);
        $header = array("Concierge ID", "Client Name", "Supplier", "Created Date", "Status", "Action");
        $body = [];
        if (sizeof($concierge_list) > 0) {
            foreach ($concierge_list as $concierge) {
                array_push($body, array(
                    $concierge->getId(),
                    $concierge->getClientName(),
                    $concierge->getSupplierName(),
                    $concierge->getTimestamp(),
                    $concierge->getStatus(),
                    "<a class='icon_edit' title='View Detail' href='" . SERVER_URL . "admin/main.php?view= concierge_update&con_id=" .
                        $concierge->getId() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>"
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