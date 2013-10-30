<?php
namespace  modules\deal_steal\includes\classes;

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
    public $image;
    public $thumbnail;
    public $voucher;
    public $has_geo_data;
    public $longitude;
    public $latitude;
    public $active;

    /**
     * @param mixed $has_geo_data
     */
    public function setHasGeoData($has_geo_data)
    {
        $this->has_geo_data = $has_geo_data;
    }

    /**
     * @return mixed
     */
    public function getHasGeoData()
    {
        return $this->has_geo_data;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $voucher
     */
    public function setVoucher($voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * @return mixed
     */
    public function getVoucher()
    {
        return $this->voucher;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }



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

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function getDiscountRate(){
        return round (($this->getOriginalPrice() - $this->getOfferPrice())/$this->getOriginalPrice(), 2) * 100;
    }

    public function getNumBought(){
        return $this->original_quantity - $this->quantity;
    }

    public function getTooltipMsg(){
        $msg = "Supplier: " .$this->getSupplierName();
        $msg = $msg."<br/>Online Date: ".$this->getOnlineDate();
        $msg = $msg."<br/>Offline Date: ".$this->getOfflineDate();
        $msg = $msg."<br/>Availability: ".$this->getOriginalQuantity() . "/" . $this->getQuantity();
        return $msg;
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
                              image,
                              thumbnail,
                              voucher_template,
                              has_geo_data,
                              latitude,
                              longitude,
                              ds_deal.active
                            FROM
                              ds_deal,
                              ds_category,
                              ds_supplier,
                              ds_city
                            WHERE ds_deal.deal_id = " . $id . "
                              AND ds_deal.active = 'Y'
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
            $this->setThumbnail($newArray['thumbnail']);
            $this->setImage($newArray['image']);
            $this->setVoucher($newArray['voucher_template']);
            $this->setHasGeoData($newArray['has_geo_data']);
            $this->setLatitude($newArray['latitude']);
            $this->setLongitude($newArray['longitude']);
            $this->setActive($newArray['active']);
        }

        $num_rows = mysql_num_rows($result); // Find no. of rows retrieved from DB

        if ($num_rows == 1) {
            $fetch_success = true; // login successful
        } else {
            $fetch_success = false; // login failure
        }
        return $fetch_success;
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
                                 voucher_template,
                                 has_geo_data,
                                 latitude,
                                 longitude,
                                 deal_desc)
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
                            '" . $this->getVoucher() . "',
                            'N',
                            0,
                            0,
                            '" . $this->getDesc() . "');";

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
                      has_geo_data = '" . $this->getHasGeoData() . "',
                      latitude = " . $this->getLatitude() . ",
                      longitude = " . $this->getLongitude() . "
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

    public function updateDescription()
    {
        $link = getConnection();
        $query = "  UPDATE ds_deal
                    SET
                      deal_desc = '" . $this->getDesc() . "'
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

    public function updateVoucherTemplate()
    {
        $link = getConnection();
        $query = "  UPDATE ds_deal
                    SET voucher_template = '" . $this->getVoucher() . "'
                    WHERE deal_id  = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function updateImage()
    {
        $link = getConnection();
        $query = "  UPDATE ds_deal
                    SET image = '" . $this->getImage() . "'
                    WHERE deal_id  = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function updateThumbnail()
    {
        $link = getConnection();
        $query = "  UPDATE ds_deal
                    SET thumbnail = '" . $this->getThumbnail() . "'
                    WHERE deal_id  = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function delete()
    {
        $link = getConnection();
        $query = " UPDATE ds_deal
                   SET    active = 'N'
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
            "Deal" => "D",
            "Voucher" => "V"
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