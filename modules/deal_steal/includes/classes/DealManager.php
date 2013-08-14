<?php
namespace modules\deal_steal\includes\classes;

class DealManager
{
    private function loadAllDeals($archived = "N")
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

    private function loadDealBySupplier($supplier_id)
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
                            WHERE deal_archived = 'N'
                              AND ds_category.category_id = ds_deal.category_id
                              AND ds_city.city_id = ds_deal.city_id
                              AND ds_supplier.supplier_id = ds_deal.supplier_id
                              AND ds_deal.supplier_id = ".$supplier_id;
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
        $dataSource = array();
        if (sizeof($deal_list) > 0) {
            foreach ($deal_list as $deal) {
                array_push($dataSource, array(
                    "id" => $deal->getId(),
                    "supplier" => $deal->getSupplierName(),
                    "category" => $deal->getCategoryName(),
                    "city" => $deal->getCityName(),
                    "type" => $deal->getType(),
                    "title" => $deal->getTitle(),
                    "quantity" => $deal->getOriginalQuantity() . "/" . $deal->getQuantity(),
                    "online_date" => $deal->getOnlineDate(),
                    "offline_date" => $deal->getOfflineDate(),
                    "action" => ""
                ));
            }
        }
        return $dataSource;
    }

    public function getDealListDataSource($supplier_id){
        $deal_list = $this->loadDealBySupplier($supplier_id);
        $dataSource = array();
        $data = array();
        if (sizeof($deal_list) > 0) {
            foreach ($deal_list as $deal) {
                array_push($data, array(
                    "id" => $deal->getId(),
                    "name" => $deal->getTitle(),
                ));
            }
        }
        $dataSource = array(
            "data" => $data,
        );
        return $dataSource;
    }

    public function getDealsListDataSource()
    {
        $deal_list = $this->loadAllDeals();
        $dataSource = array();
        if (sizeof($deal_list) > 0) {
            foreach ($deal_list as $deal) {
                $dataSource[$deal->getId()] = $deal->getSupplierName() . " - " . $deal->getTitle();
            }
        }
        return $dataSource;
    }
}

?>