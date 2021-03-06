<?php
namespace modules\deal_steal\includes\classes;

class DealManager
{
    public function clientFetchSingleDealFullDetail($deal_id)
    {
        $link = getConnection();
        $query = " SELECT     ds_deal.deal_id,
                              ds_deal.supplier_id,
                              ds_supplier.supplier_name,
                              supplier_logo,
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
                              thumbnail,
                              voucher_template,
                              has_geo_data,
                              google_map,
                              rate_total,
                              rate_average,
                              ds_deal.active
                            FROM
                              ds_deal,
                              ds_category,
                              ds_supplier,
                              ds_city
                            WHERE ds_deal.deal_id = " . $deal_id . "
                              AND ds_deal.active = 'Y'
                              AND ds_category.category_id = ds_deal.category_id
                              AND ds_city.city_id = ds_deal.city_id
                              AND ds_supplier.supplier_id = ds_deal.supplier_id
                              AND now() >= online_date
                              AND now() <=  offline_date
                              AND quantity > 0";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        $deal = new Deal();
        while ($newArray = mysql_fetch_array($result)) {
            $deal->setId($newArray['deal_id']);
            $deal->setSupplierId($newArray['supplier_id']);
            $deal->setSupplierName($newArray['supplier_name']);
            $deal->setSupplierLogo($newArray['supplier_logo']);
            $deal->setCategoryId($newArray['category_id']);
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
            $deal->setThumbnail($newArray['thumbnail']);
            $deal->setImage($newArray['image']);
            $deal->setVoucher($newArray['voucher_template']);
            $deal->setHasGeoData($newArray['has_geo_data']);
            $deal->setGoogleMap($newArray['google_map']);
            $deal->setRateAverage($newArray['rate_average']);
            $deal->setRateTotal($newArray['rate_total']);
            $deal->setActive($newArray['active']);
            return $deal;
        }
        return null;
    }

    public function clientFetchLatestDealList($size = 4)
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
                              thumbnail,
                              voucher_template,
                              has_geo_data,
                              google_map,
                              rate_total,
                              rate_average,
                              ds_deal.active
                            FROM
                              ds_deal,
                              ds_category,
                              ds_supplier,
                              ds_city
                            WHERE ds_deal.active = 'Y'
                              AND ds_category.category_id = ds_deal.category_id
                              AND ds_city.city_id = ds_deal.city_id
                              AND ds_supplier.supplier_id = ds_deal.supplier_id
                              AND now() >= online_date
                              AND now() <=  offline_date
                              AND quantity > 0
                            ORDER BY online_date DESC
                            LIMIT 0, " . $size;
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
            $deal->setThumbnail($newArray['thumbnail']);
            $deal->setVoucher($newArray['voucher_template']);
            $deal->setHasGeoData($newArray['has_geo_data']);
            $deal->setGoogleMap($newArray['google_map']);
            $deal->setRateAverage($newArray['rate_average']);
            $deal->setRateTotal($newArray['rate_total']);
            $deal->setActive($newArray['active']);
            array_push($deal_list, $deal);
        }
        return $deal_list;
    }

    public function clientUpdateDealRating($client_id, $deal_id, $rate_value)
    {
        if (!$this->checkClientHasVoteDealBefore($client_id, $deal_id)) {
            $link = getConnection();
            $query = "  UPDATE ds_deal
                        SET rate_average = ((rate_average*rate_total)+ " . $rate_value . " )/(rate_total+1),
                        rate_total = rate_total + 1
                        WHERE deal_id  = " . $deal_id;
            executeUpdateQuery($link, $query);

            $query1 = "INSERT INTO ds_rate_it
                        (deal_id,
                        client_id)
                        VALUES (" . $deal_id . ",
                        " . $client_id . ")";
            executeUpdateQuery($link, $query1);
        }
    }

    public function checkClientHasVoteDealBefore($client_id, $deal_id)
    {
        $link = getConnection();
        $query = " SELECT     ds_rate_it.deal_id,
                              ds_rate_it.client_id
                            FROM
                              ds_rate_it
                            WHERE ds_rate_it.deal_id = " . $deal_id . "
                              AND ds_rate_it.client_id = " . $client_id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        $num_rows = mysql_num_rows($result); // Find no. of rows retrieved from DB

        if ($num_rows > 0) {
            $has_voted = true; // client has voted before for this deal
        } else {
            $has_voted = false; //client has not yet voted before for this deal
        }
        return $has_voted;
    }

    public function loadAllDeals($active = "Y")
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
                              thumbnail,
                              voucher_template,
                              has_geo_data,
                              google_map,
                              rate_total,
                              rate_average,
                              ds_deal.active
                            FROM
                              ds_deal,
                              ds_category,
                              ds_supplier,
                              ds_city
                            WHERE ds_deal.active = '" . $active . "'
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
            $deal->setThumbnail($newArray['thumbnail']);
            $deal->setVoucher($newArray['voucher_template']);
            $deal->setHasGeoData($newArray['has_geo_data']);
            $deal->setGoogleMap($newArray['google_map']);
            $deal->setRateAverage($newArray['rate_average']);
            $deal->setRateTotal($newArray['rate_total']);
            $deal->setActive($newArray['active']);
            array_push($deal_list, $deal);
        }
        return $deal_list;
    }

    public function loadDealBySupplier($supplier_id)
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
                              thumbnail,
                              voucher_template,
                              has_geo_data,
                              google_map,
                              rate_total,
                              rate_average,
                              ds_deal.active
                            FROM
                              ds_deal,
                              ds_category,
                              ds_supplier,
                              ds_city
                            WHERE ds_deal.active = 'Y'
                              AND ds_category.category_id = ds_deal.category_id
                              AND ds_city.city_id = ds_deal.city_id
                              AND ds_supplier.supplier_id = ds_deal.supplier_id
                              AND ds_deal.supplier_id = " . $supplier_id;
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
            $deal->setThumbnail($newArray['thumbnail']);
            $deal->setVoucher($newArray['voucher_template']);
            $deal->setHasGeoData($newArray['has_geo_data']);
            $deal->setGoogleMap($newArray['google_map']);
            $deal->setRateAverage($newArray['rate_average']);
            $deal->setRateTotal($newArray['rate_total']);
            $deal->setActive($newArray['active']);
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

    public function getDealListDataSource($supplier_id)
    {
        $deal_list = $this->loadDealBySupplier($supplier_id);
        $dataSource = array();
        $data = array();
        if (sizeof($deal_list) > 0) {
            foreach ($deal_list as $deal) {
                array_push($data, array(
                    "id" => $deal->getId(),
                    "name" => $deal->getTitle(),
                    "tooltip" => $deal->getTooltipMsg()
                ));
            }
        }
        $dataSource = array(
            "data" => $data,
        );
        return $dataSource;
    }

    public function getDealTypeListDataSource()
    {
        $data = array();
        array_push($data, array(
            "id" => "D",
            "name" => "Deal"
        ));
        array_push($data, array(
            "id" => "V",
            "name" => "Voucher"
        ));
        $dataSource = array(
            "data" => $data,
            "selected_value" => ""
        );
        return $dataSource;
    }
}

?>