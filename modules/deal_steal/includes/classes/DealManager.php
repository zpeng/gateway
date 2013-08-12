<?php
namespace modules\deal_steal\includes\classes;

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

    public function loadDealsOfTheDays()
    {
        $begin_of_month = date("Y-m-1", strtotime(date("Y-m-t")));
        $deal_list = array();
        $link = getConnection();
        $query = " SELECT     ds_deal_of_day.id,
                              ds_deal.deal_id,
                              CONCAT(ds_supplier.supplier_name, ' - ', ds_deal.deal_title) as deal_title,
                              ds_deal_of_day.date
                            FROM
                              ds_deal,
                              ds_supplier,
                              ds_deal_of_day
                            WHERE deal_archived = 'N'
                              AND ds_supplier.supplier_id = ds_deal.supplier_id
                              AND ds_deal_of_day.deal_id = ds_deal.deal_id
                    AND ds_deal_of_day.date >= '" . $begin_of_month . "'";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $dod = new DealOfDay();
            $dod->setId($newArray['id']);
            $dod->setDealId($newArray['deal_id']);
            $dod->setTitle($newArray['deal_title']);
            $dod->setDate($newArray['date']);
            array_push($deal_list, $dod);
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

    public function getDealsListDataSource()
    {
        $deal_list = $this->loadAllDeals();
        $dataSource = array();
        if (sizeof($deal_list) > 0) {
            foreach ($deal_list as $deal) {
                $dataSource[$deal->getId()] = $deal->getSupplierName()." - ".$deal->getTitle();
            }
        }
        return $dataSource;
    }

    public function getDealOfTheDayDataSource()
    {
        $deal_list = $this->loadDealsOfTheDays();
        $dataSource = array();
        if (sizeof($deal_list) > 0) {
            foreach ($deal_list as $dod) {
                array_push($dataSource, array(
                    'id' => $dod->getId(),
                    'title' => $dod->getTitle() . ", " . $dod->getTitle(),
                    'start' => $dod->getDate(),
                    'url' => ""
                ));
            }
        }
        return $dataSource;
    }
}

?>