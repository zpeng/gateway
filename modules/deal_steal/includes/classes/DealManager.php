<?php
class DealManager
{
    public function loadAllDeals($archived = "N")
    {
        $deal_list = array();
        $link = getConnection();
        $query = " SELECT     ds_deal.deal_id,
                              ds_deal.supplier_id,
                              ds_supplier.supplier_name,
                              ds_deal.category_id,
                              ds_category.category_name,
                              ds_deal.city_id,
                              ds_city.city_name,
                              deal_title,
                              deal_type,
                              original_quantity,
                              quantity,
                              original_price,
                              offer_price,
                              online_date,
                              offline_date,
                              fine_print,
                              deal_desc,
                              image,
                              deal_archived
                            FROM
                              ds_deal,
                              ds_category,
                              ds_supplier,
                              ds_city
                            WHERE deal_archived = '" . $archived . "'
                              AND ds_category.category_id = ds_deal.category_id
                              AND ds_city.city_id = ds_deal.city_id
                              AND ds_supplier.supplier_id = ds_deal.supplier_id";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $deal = new Deal();
            $deal->setId($newArray['deal_id']);
            $deal->setSupplierId($newArray['supplier_id']);
            $deal->setSupplierName($newArray['supplier_name']);
            $deal->setSupplierId($newArray['category_id']);
            $deal->setCategoryName($newArray['category_name']);
            $deal->setCityId($newArray['city_id']);
            $deal->setCityName($newArray['city_name']);
            $deal->setTitle($newArray['deal_title']);
            $deal->setType($newArray['deal_type']);
            $deal->setOriginalQuantity($newArray['original_quantity']);
            $deal->setQuantity($newArray['quantity']);
            $deal->setOriginalPrice($newArray['original_price']);
            $deal->setOfferPrice($newArray['offer_price']);
            $deal->setOnlineDate($newArray['online_date']);
            $deal->setOfflineDate($newArray['offline_date']);
            $deal->setFinePrint($newArray['fine_print']);
            $deal->setDesc($newArray['deal_desc']);
            $deal->setImage($newArray['image']);
            $deal->setArchived($newArray['deal_archived']);
            array_push($deal_list, $deal);
        }
        return $deal_list;
    }

    public function getDealsTableDataSource()
    {
        $deal_list = $this->loadAllDeals();
        $header = array("ID", "Supper", "Category", "City", "Title", "Type", "Available Quantity", "Online Date", "Offline Date", "Action");
        $body = [];
        if (sizeof($deal_list) > 0) {
            foreach ($deal_list as $deal) {
                array_push($body, array(
                    $deal->getId(),
                    $deal->getSupplierName(),
                    $deal->getCategoryName(),
                    $deal->getCityName(),
                    $deal->getTitle(),
                    $deal->getType(),
                    $deal->getOriginalQuantity() . "/" . $deal->getQuantity(),
                    $deal->getOnlineDate(),
                    $deal->getOfflineDate(),
                    "<a class='icon_edit' title='Update Deal' href='" . SERVER_URL . "admin/main.php?view=deal_update&deal_id=" .
                        $deal->getId() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>"
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