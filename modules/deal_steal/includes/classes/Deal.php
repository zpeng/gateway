<?php
class Deal
{
    public $id;
    public $supplier_id;
    public $supplier_name;
    public $category_id;
    public $category_name;
    public $city_id;
    public $city_name;
    public $title;
    public $type;
    public $desc;
    public $original_quantity;
    public $quantity;
    public $original_price;
    public $offer_price;
    public $online_date;
    public $offline_date;
    public $fine_print;
    public $archived;

    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }

    public function setCityName($city_name)
    {
        $this->city_name = $city_name;
    }

    public function getCityName()
    {
        return $this->city_name;
    }

    public function setSupplierName($supplier_name)
    {
        $this->supplier_name = $supplier_name;
    }

    public function getSupplierName()
    {
        return $this->supplier_name;
    }


    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    public function getArchived()
    {
        return $this->archived;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }

    public function getCityId()
    {
        return $this->city_id;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setFinePrint($fine_print)
    {
        $this->fine_print = $fine_print;
    }

    public function getFinePrint()
    {
        return $this->fine_print;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setOfferPrice($offer_price)
    {
        $this->offer_price = $offer_price;
    }

    public function getOfferPrice()
    {
        return $this->offer_price;
    }

    public function setOfflineDate($offline_date)
    {
        $this->offline_date = $offline_date;
    }

    public function getOfflineDate()
    {
        return $this->offline_date;
    }

    public function setOnlineDate($online_date)
    {
        $this->online_date = $online_date;
    }

    public function getOnlineDate()
    {
        return $this->online_date;
    }

    public function setOriginalPrice($original_price)
    {
        $this->original_price = $original_price;
    }

    public function getOriginalPrice()
    {
        return $this->original_price;
    }

    public function setOriginalQuantity($original_quantity)
    {
        $this->original_quantity = $original_quantity;
    }

    public function getOriginalQuantity()
    {
        return $this->original_quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setSupplierId($supplier_id)
    {
        $this->supplier_id = $supplier_id;
    }

    public function getSupplierId()
    {
        return $this->supplier_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    /********************** functions **********************/
    public function loadById($id)
    {
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
                              deal_archived
                            FROM
                              ds_deal,
                              ds_category,
                              ds_supplier,
                              ds_city
                            WHERE ds_deal.deal_id = " . $id . "
                              AND deal_archived = 'N'
                              AND ds_category.category_id = ds_deal.category_id
                              AND ds_city.city_id = ds_deal.city_id
                              AND ds_supplier.supplier_id = ds_deal.supplier_id";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->setId($newArray['deal_id']);
            $this->setSupplierId($newArray['supplier_id']);
            $this->setSupplierName($newArray['supplier_name']);
            $this->setCategoryId($newArray['category_id']);
            $this->setCategoryName($newArray['category_name']);
            $this->setCityId($newArray['city_id']);
            $this->setCityName($newArray['city_name']);
            $this->setTitle($newArray['deal_title']);
            $this->setType($newArray['deal_type']);
            $this->setOriginalQuantity($newArray['original_quantity']);
            $this->setQuantity($newArray['quantity']);
            $this->setOriginalPrice($newArray['original_price']);
            $this->setOfferPrice($newArray['offer_price']);
            $this->setOnlineDate($newArray['online_date']);
            $this->setOfflineDate($newArray['offline_date']);
            $this->setFinePrint($newArray['fine_print']);
            $this->setDesc($newArray['deal_desc']);
            $this->setArchived($newArray['deal_archived']);
        }
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO   ds_deal
                                (supplier_id,
                                 category_id,
                                 city_id,
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
                                 deal_archived)
                    VALUES (" . $this->getSupplierId() . ",
                            " . $this->getCategoryId() . ",
                            " . $this->getCityId() . ",
                            '" . $this->getTitle() . "',
                            '" . $this->getType() . "',
                            " . $this->getOriginalQuantity() . ",
                            " . $this->getQuantity() . ",
                            " . $this->getOriginalPrice() . ",
                            " . $this->getOfferPrice() . ",
                            '" . $this->getOnlineDate() . "',
                            '" . $this->getOfflineDate() . "',
                            '" . $this->getFinePrint() . "',
                            '" . $this->getDesc() . "',
                            'N');";

        executeUpdateQuery($link, $query);
        $last_insert_id = mysql_insert_id();
        closeConnection($link);
        return $last_insert_id;
    }

    public function update()
    {
        $link = getConnection();
        $query = "  UPDATE ds_deal
                    SET
                      supplier_id = " . $this->getSupplierId() . ",
                      city_id = " . $this->getCityId() . ",
                      deal_title = '" . $this->getTitle() . "',
                      deal_type = '" . $this->getType() . "',
                      original_quantity = " . $this->getOriginalQuantity() . ",
                      quantity = " . $this->getQuantity() . ",
                      original_price = " . $this->getOriginalPrice() . ",
                      offer_price = " . $this->getOfferPrice() . ",
                      online_date = '" . $this->getOnlineDate() . "',
                      offline_date = '" . $this->getOfflineDate() . "',
                      deal_desc = '" . $this->getDesc() . "'
                    WHERE deal_id  = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function updateCategory()
    {
        $link = getConnection();
        $query = "  UPDATE ds_deal
                    SET
                      category_id = " . $this->getCategoryId() . "
                    WHERE deal_id  = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function updateFinePrint()
    {
        $link = getConnection();
        $query = "  UPDATE ds_deal
                    SET fine_print = '" . $this->getFinePrint() . "'
                    WHERE deal_id  = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function delete()
    {
        $link = getConnection();
        $query = " UPDATE ds_deal
                   SET    deal_archived = 'Y'
                   WHERE deal_id  = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function getSelectedSupplierListDataSource()
    {
        $supplier_manager = new SupplierManager();
        $dataSource = $supplier_manager->getSupplierListDataSource();
        $selected = array();
        $selected[$this->getSupplierName()] = $this->getSupplierId();
        $dataSource["selected"] = $selected;
        return $dataSource;
    }

    public function getSelectedDealTypeListDataSource()
    {
        $data = array(
            "Single" => "S",
            "Multiple" => "M"
        );
        $selected = array();
        $selected[array_search($this->getType(), $data)] = $this->getType();
        $dataSource = array(
            "data" => $data,
            "selected" => $selected
        );
        return $dataSource;
    }

    public function getSelectedCityListDataSource()
    {
        $city_manager = new CityManager();
        $data_source = $city_manager->getCityListDataSource();
        $data_source["selected"] = array(
            $this->getCityName() => $this->getCityId()
        );
        return $data_source;
    }

    public function getDealTagsDataSource()
    {
        $data = array();
        $link = getConnection();
        $query = " SELECT ds_tag.tag_id, ds_tag.tag_value
                    FROM  ds_deal_tag, ds_tag
                    WHERE ds_deal_tag.tag_id = ds_tag.tag_id
                    AND ds_deal_tag.deal_id = " . $this->getId();

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $data[$newArray['tag_id']] = $newArray['tag_value'];
        }
        $dataSource = array(
            "data" => $data
        );
        return $dataSource;
    }

    public function getAvailableTagsDataSource()
    {
        $data = array();
        $link = getConnection();
        $query = "SELECT tag_id,  tag_value
                    FROM   ds_tag
                    WHERE tag_id NOT IN
                    (SELECT ds_tag.tag_id
                    FROM  ds_deal_tag, ds_tag
                    WHERE ds_deal_tag.tag_id = ds_tag.tag_id
                    AND ds_deal_tag.deal_id = " . $this->getId() . ") ";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $data[$newArray['tag_id']] = $newArray['tag_value'];
        }
        $dataSource = array(
            "data" => $data
        );
        return $dataSource;
    }
}

?>