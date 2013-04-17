<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Product
 *
 * @author ziyang
 */
class Product {
//put your code here

    private $_product_id;
    private $_product_sku;

    private $_manufacturer_id;
    private $_manufacturer; //obj



    private $_product_description_list; //obj list

    private $_product_attribute_list; //obj list

    private $_product_attribute_value_id_list;

    private $_product_review_list; //obj list

    private $_category_list;
    private $_category_id_list;



    private $_product_cost;
    private $_product_price;
    private $_product_onsale;
    private $_product_presale_price;

    private $_product_url;
    private $_product_weigth;


    private $_product_date_added;
    private $_product_date_available;

    private $_product_stock_level;
    private $_product_viewed_count;
    private $_product_ordered_count;

    private $_product_archived;

    public function get_product_id() {
        return $this->_product_id;
    }

    public function set_product_id($_product_id) {
        $this->_product_id = $_product_id;
    }

    public function get_manufacturer_id() {
        return $this->_manufacturer_id;
    }

    public function set_manufacturer_id($_manufacturer_id) {
        $this->_manufacturer_id = $_manufacturer_id;
    }

    public function get_manufacturer() {
        $brand = new Manufacturer();
        $brand->load($this->get_manufacturer_id());
        $this->set_manufacturer($brand);
        return $this->_manufacturer;
    }

    public function set_manufacturer($_manufacturer) {
        $this->_manufacturer = $_manufacturer;
    }


    public function get_product_sku() {
        return $this->_product_sku;
    }

    public function set_product_sku($_product_sku) {
        $this->_product_sku = $_product_sku;
    }

    public function get_product_description_list() {
        if ($this->_product_description_list == null) {
            $this->load_product_description_list();
        }
        return $this->_product_description_list;
    }

    public function set_product_description_list($_product_description_list) {
        $this->_product_description_list = $_product_description_list;
    }

    public function get_product_attribute_value_id_list() {
        return $this->_product_attribute_value_id_list;
    }

    public function set_product_attribute_value_id_list($_product_attribute_value_id_list) {
        $this->_product_attribute_value_id_list = $_product_attribute_value_id_list;
    }

    public function get_product_attribute_list() {
        if ( $this->_product_attribute_list == null) {
            $this->load_product_attributes();
        }
        return $this->_product_attribute_list;
    }

    public function set_product_attribute_list($_product_attribute_list) {
        $this->_product_attribute_list = $_product_attribute_list;
    }


    public function get_product_review_list() {
        if ($this->_product_review_list == null) {
            $this->set_product_review_list($this->load_all_product_review());
        }
        return $this->_product_review_list;
    }

    public function set_product_review_list($_product_review_list) {
        $this->_product_review_list = $_product_review_list;
    }


    public function get_product_cost() {
        return $this->_product_cost;
    }

    public function set_product_cost($_product_cost) {
        $this->_product_cost = $_product_cost;
    }

    public function get_product_price() {
        return $this->_product_price;
    }

    public function set_product_price($_product_price) {
        $this->_product_price = $_product_price;
    }

    public function get_product_onsale() {
        return $this->_product_onsale;
    }

    public function get_product_onsale_as_icon() {
        $field = "";
        if ($this->_product_onsale == 'Y') {
            $field = $field."<img border='0' width='15' height='15' src='images/green_status.png'/>";
        }else {
            $field = $field."<img border='0' width='15' height='15' src='images/status-offline.png'/>";
        }
        return $field;
    }

    public function set_product_onsale($_product_onsale) {
        $this->_product_onsale = $_product_onsale;
    }

    public function get_product_presale_price() {
        return $this->_product_presale_price;
    }

    public function get_product_presale_price_if_onale() {
        if ($this->_product_onsale == 'Y') {
            return $this->_product_presale_price;
        }else {
            return "";
        }
    }

    public function set_product_presale_price($_product_presale_price) {
        $this->_product_presale_price = $_product_presale_price;
    }

    public function get_product_url() {
        return $this->_product_url;
    }

    public function set_product_url($_product_url) {
        $this->_product_url = $_product_url;
    }

    public function get_product_weigth() {
        return $this->_product_weigth;
    }

    public function set_product_weigth($_product_weigth) {
        $this->_product_weigth = $_product_weigth;
    }

    public function get_product_date_added() {
        return $this->_product_date_added;
    }

    public function set_product_date_added($_product_date_added) {
        $this->_product_date_added = $_product_date_added;
    }

    public function get_product_date_available() {
        return $this->_product_date_available;
    }

    public function set_product_date_available($_product_date_available) {
        $this->_product_date_available = $_product_date_available;
    }

    public function get_product_stock_level() {
        return $this->_product_stock_level;
    }

    public function set_product_stock_level($_product_stock_level) {
        $this->_product_stock_level = $_product_stock_level;
    }

    public function get_product_viewed_count() {
        return $this->_product_viewed_count;
    }

    public function set_product_viewed_count($_product_viewed_count) {
        $this->_product_viewed_count = $_product_viewed_count;
    }

    public function get_product_ordered_count() {
        return $this->_product_ordered_count;
    }

    public function set_product_ordered_count($_product_ordered_count) {
        $this->_product_ordered_count = $_product_ordered_count;
    }

    public function get_product_archived() {
        return $this->_product_archived;
    }

    public function set_product_archived($_product_archived) {
        $this->_product_archived = $_product_archived;
    }


    public function get_product_archived_as_icon() {
        $field = "";
        if ($this->_product_archived == 'N') {
            $field = $field."<img border='0' width='15' height='15' src='images/green_status.png'/>";
        }else {
            $field = $field."<img border='0' width='15' height='15' src='images/status-offline.png'/>";
        }
        return $field;
    }


    public function get_category_list() {
        if ($this->_category_list == null) {
            $this->set_category_list($this->get_product_to_category_list());
        }
        return $this->_category_list;
    }

    public function set_category_list($_category_list) {
        $this->_category_list = $_category_list;
    }

    public function get_category_id_list() {
        if ($this->_category_id_list == null) {
            if (sizeof($this->get_category_list())>0) {
                $count=0;
                $category_id_list = null;
                foreach ($this->get_category_list() as $category) {
                    $category_id_list[$count] = $category->get_category_id();
                    $count++;
                }
                $this->set_category_id_list($category_id_list);
            }
        }
        return $this->_category_id_list;
    }

    public function set_category_id_list($_category_id_list) {
        $this->_category_id_list = $_category_id_list;
    }


    public function load($product_id) {
        $link = getConnection();
        $query=" select     product_id,
                            manufacturer_id,
                            product_sku,
                            product_weigth,
                            product_cost,
                            product_price,
                            product_onsale,
                            product_price_presale,
                            product_url,
                            product_date_added,
                            product_date_available,
                            product_stock_level,
                            product_viewed_count,
                            product_ordered_count,
                            product_archived
                    from    tb_product
                    where   product_id = ".$product_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_product_id($newArray['product_id']);
            $this->set_manufacturer_id($newArray['manufacturer_id']);
            $this->set_product_sku($newArray['product_sku']);
            $this->set_product_weigth($newArray['product_weigth']);
            $this->set_product_cost($newArray['product_cost']);
            $this->set_product_price($newArray['product_price']);
            $this->set_product_onsale($newArray['product_onsale']);
            $this->set_product_presale_price($newArray['product_price_presale']);
            $this->set_product_url($newArray['product_url']);
            $this->set_product_date_added($newArray['product_date_added']);
            $this->set_product_date_available($newArray['product_date_available']);
            $this->set_product_stock_level($newArray['product_stock_level']);
            $this->set_product_viewed_count($newArray['product_viewed_count']);
            $this->set_product_ordered_count($newArray['product_ordered_count']);
            $this->set_product_archived($newArray['product_archived']);

        }
    }

    public function insert() {
        $product_id = 0;
        $link = getConnection();
        $query = "  INSERT
                    INTO   tb_product
                           (
                                  manufacturer_id,
                                  product_sku,
                                  product_date_added,
                                  product_date_available,
                                  product_stock_level
                           )
                           VALUES
                           (
                                  ".$this->get_manufacturer_id()."   ,
                                  '".$this->get_product_sku()."'   ,
                                  now()  ,
                                  '".$this->get_product_date_available()."' ,
                                  '".$this->get_product_stock_level()."')";

        executeUpdateQuery($link , $query);
        $product_id = mysql_insert_id($link);
        closeConnection($link);

        $this->set_product_id($product_id);
        return $product_id;
    }

    public function delete() {
        $link = getConnection();
        $query = "  UPDATE tb_product
                    SET    product_archived = 'Y'
                    WHERE  product_id    = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function undelete() {
        $link = getConnection();
        $query = "  UPDATE tb_product
                    SET    product_archived = 'N'
                    WHERE  product_id    = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_product
                  SET    manufacturer_id        = ".$this->get_manufacturer_id().",
                         product_sku            = '".$this->get_product_sku()."',
                         product_weigth         = ".$this->get_product_weigth().",
                         product_cost           = ".$this->get_product_cost().",
                         product_price          = ".$this->get_product_price().",
                         product_onsale         = '".$this->get_product_onsale()."',
                         product_price_presale  = ".$this->get_product_presale_price().",
                         product_url            = '".$this->get_product_url()."',
                         product_date_available = '".$this->get_product_date_available()."',
                         product_stock_level    = ".$this->get_product_stock_level()."
                   WHERE  product_id = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }


    public function updateProductStockLevel($quantity = "-1") {
        $link = getConnection();
        $query = "UPDATE tb_product
                  SET    product_stock_level = product_stock_level ".$quantity."
                  WHERE  product_id = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function updateProductViewedCount($viewed_count = "+1") {
        $link = getConnection();
        $query = "UPDATE tb_product
                  SET    product_viewed_count = product_viewed_count ".$viewed_count."
                  WHERE  product_id = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }



    public function updateProductDescriptionList() {
        if($this->get_product_description_list() != null) {
            foreach($this->get_product_description_list() as $product_description) {
                if ( $product_description->get_product_description_id() == 0 ) {
                    $product_description->insert();
                }else {
                    $product_description->update();
                }
            }
        }
    }

    private function load_product_attributes() {
        $productAttributeList = null;
        $count=0;
        $link = getConnection();
        $query="  select    product_id,
                            tb_product_to_attribute_value.attribute_value_id,
                            attribute_id,
                            attribute_value
                    from    tb_product_to_attribute_value ,
                            tb_attribute_value
                    where   tb_product_to_attribute_value.attribute_value_id = tb_attribute_value.attribute_value_id
                    and     product_id = ".$this->get_product_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {

            $attributeValue = new AttributeValue();

            $attributeValue->set_attribute_value_id($newArray['attribute_value_id']);
            $attributeValue->set_attribute_value($newArray['attribute_value']);
            $attributeValue->set_attribute_id($newArray['attribute_id']);
            $productAttributeList[$count] = $attributeValue;
            $count++;
        }
        $this->set_product_attribute_list($productAttributeList);
    }

    private function load_product_description_list() {
        $productDescriptionList = null;
        $count=0;
        $link = getConnection();
        $query="select 	product_description_id, product_id, language_id, product_name,
                        product_description
                from    tb_product_description
                where   product_id = ".$this->get_product_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {

            $productDescription = new ProductDescription();

            $productDescription->set_product_description_id($newArray['product_description_id']);
            $productDescription->set_product_id($newArray['product_id']);
            $productDescription->set_language_id($newArray['language_id']);
            $productDescription->set_product_name($newArray['product_name']);
            $productDescription->set_product_description($newArray['product_description']);

            $productDescriptionList[$count] = $productDescription;
            $count++;
        }
        $this->set_product_description_list($productDescriptionList);
    }

    public function getProductDescriptionByLanguageID($language_id) {
        if (sizeof($this->get_product_description_list()) > 0 ) {
            foreach($this->get_product_description_list() as $_product_desc) {
                if ($_product_desc->get_language_id() == $language_id) {
                    return $_product_desc;
                }
            }
        }
        return null;
    }


    private function get_product_to_category_list() {
        $link = getConnection();
        $count = 0;
        $category_list = null;
        $query="SELECT 	tb_category.id, parent_id, name, category_description
                FROM	tb_category , tb_product_to_category
                WHERE   tb_category.id = tb_product_to_category.id
                AND     tb_product_to_category.product_id =".$this->get_product_id();

        $result = executeNonUpdateQuery($link , $query, "product.get_product_to_category_list()" );
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $category = new Category();
            $category->set_category_id($newArray['id']);
            $category->set_category_parent_id($newArray['parent_id']);
            $category->set_category_name($newArray['name']);
            $category->set_category_desc($newArray['category_description']);

            $category_list[$count] =$category;
            $count++;
        }

        return $category_list;
    }

    public function updateProductToCategoryList() {
        //1st delete all records from table tb_content_to_category
        $this->delete_all_product_to_category();

        //2nd insert all new records into table tb_content_to_category
        $this->insert_product_to_category();
    }


    private function delete_all_product_to_category() {
        $link = getConnection();
        $query = "  DELETE From tb_product_to_category
                    WHERE  product_id = ".$this->get_product_id();
        executeUpdateQuery($link, $query,"product.delete_all_product_to_category()");
        closeConnection($link);
    }

    private function insert_product_to_category() {
        if (sizeof($this->get_category_id_list())>0) {
            foreach ($this->get_category_id_list() as $category_id) {
                $link = getConnection();
                $query = "INSERT INTO tb_product_to_category
                        (product_id,
                         id)
                         VALUES	(
                         ".$this->get_product_id().",
                         ".$category_id.")";
                executeUpdateQuery($link, $query,"product.insert_product_to_category()");
                closeConnection($link);
            }
        }
    }

    public function getProductAttributeValueList() {
        $link = getConnection();
        $count = 0;
        $attribute_value_list = null;
        $query="select 	tb_attribute_value.attribute_value_id, attribute_id, attribute_value
                from    tb_product_to_attribute_value , tb_attribute_value
                where   tb_product_to_attribute_value.attribute_value_id = tb_attribute_value.attribute_value_id
                and     product_id =  ".$this->get_product_id();

        $result = executeNonUpdateQuery($link , $query, "product.getProductAttributeValueList()" );
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $attributeValue = new AttributeValue();
            $attributeValue->set_attribute_value_id($newArray['attribute_value_id']);
            $attributeValue->set_attribute_id($newArray['attribute_id']);
            $attributeValue->set_attribute_value($newArray['attribute_value']);
            $attribute_value_list[$count] =$attributeValue;
            $count++;
        }

        return $attribute_value_list;
    }

    public function deleteProductAttributeByAttributeID($attribute_id) {
        $link = getConnection();
        $query = "  delete  from tb_product_to_attribute_value
                    where product_id = ".$this->get_product_id()."
                    and  attribute_value_id in
                    (
                    select attribute_value_id
                    from tb_attribute_value
                    where attribute_id = ".$attribute_id."
                    )";
        executeUpdateQuery($link, $query,"product.deleteProductAttributeByAttributeID()");
        closeConnection($link);
    }

    public function update_product_attribute_value_List() {
        //1st delete all records from table tb_product_to_attribute_value
        $this->delete_all_product_attribute();

        //2nd insert all new records into table tb_product_to_attribute_value
        $this->insert_product_attribute();
    }

    private function delete_all_product_attribute() {
        $link = getConnection();
        $query = "  DELETE From tb_product_to_attribute_value
                    WHERE  product_id = ".$this->get_product_id();
        executeUpdateQuery($link, $query,"product.deleteAllProductAttribute()");
        closeConnection($link);
    }

    private function insert_product_attribute() {
        if (sizeof($this->get_product_attribute_value_id_list())>0) {
            foreach ($this->get_product_attribute_value_id_list() as $product_attribute_value_id) {
                $link = getConnection();
                $query = "INSERT INTO tb_product_to_attribute_value
                        (product_id, attribute_value_id)
                         VALUES	(".$this->get_product_id().",
                                 ".$product_attribute_value_id.")";
                executeUpdateQuery($link, $query,"product.insertProductToCategory()");
                closeConnection($link);
            }
        }
    }

    private function load_all_product_review() {
        $count = 0;
        $review_list = null;
        $link = getConnection();
        $query="select 	review_id,
                        customer_id,
                        product_id,
                        review_rate,
                        review_text,
                        review_date
                from    tb_review
                where   product_id = ".$this->get_product_id()."
                order by review_date desc";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $review = new Review();
            $review->set_review_id($newArray['review_id']);
            $review->set_product_id($newArray['product_id']);
            $review->set_customer_id($newArray['customer_id']);
            $review->set_review_rate($newArray['review_rate']);
            $review->set_review_text($newArray['review_text']);
            $review->set_review_date($newArray['review_date']);

            $review_list[$count] = $review;
            $count++;
        }
        return $review_list;
    }

    public function getProductAverageRating() {
        $rate = 0;
        $total_rate = 0;
        $review_list = $this->get_product_review_list();
        if (($review_list != null) && (sizeof($review_list)>0)) {
            foreach($review_list as $review) {
                $total_rate = $total_rate + $review->get_review_rate();
            }
            $rate = round($total_rate / sizeof($review_list));
        }
        return $rate;
    }

    public function incrementProductViewCount() {
        $link = getConnection();
        $query = "UPDATE tb_product
                  SET    product_viewed_count = product_viewed_count + 1
                  WHERE  product_id  = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function incrementProductOrderCount($orderQuantity) {
        $link = getConnection();
        $query = "UPDATE tb_product
                  SET    product_ordered_count = product_ordered_count + ".$orderQuantity."
                  WHERE  product_id  = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function decreaseProductStockLevel($orderQuantity) {
        $link = getConnection();
        $query = "UPDATE tb_product
                  SET    product_stock_level = product_stock_level - ".$orderQuantity."
                  WHERE  product_id  = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

}
?>
