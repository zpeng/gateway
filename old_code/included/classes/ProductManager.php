<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ProductManager
 *
 * @author ziyang
 */
class ProductManager {
    //put your code here

    public function getProductListByCondition($brand_id= "", $category_id_list= "") {
        $condition_query = "";


        if (($category_id_list != "") && (sizeof($category_id_list)>0)) {
            if ($condition_query == "") {
                $condition_query = $condition_query." ,tb_product_to_category where ";
            }else {
                $condition_query = $condition_query." and ";
            }
            $condition_query = $condition_query." tb_product_to_category.product_id = tb_product.product_id
                and tb_product_to_category.id in (";
            foreach ($category_id_list as $category_id) {
                $condition_query = $condition_query.$category_id.",";
            }
            $condition_query= trim($condition_query);
            $condition_query = substr_replace($condition_query ,"",-1);
            $condition_query = $condition_query.") ";
        }


        if ($brand_id != 0) {
            if ($condition_query == "") {
                $condition_query = $condition_query." where";
            }
            $condition_query = $condition_query." manufacturer_id = ".$brand_id;
        }
        
        $productList = null;

        $count = 0;
        $link = getConnection();
        $query=" select     distinct (tb_product.product_id),
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
                    from    tb_product  ".$condition_query;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);
        
        while ($newArray = mysql_fetch_array($result)) {
            $product = new Product();
            $product->set_product_id($newArray['product_id']);
            $product->set_manufacturer_id($newArray['manufacturer_id']);
            $product->set_product_sku($newArray['product_sku']);
            $product->set_product_weigth($newArray['product_weigth']);
            $product->set_product_cost($newArray['product_cost']);
            $product->set_product_price($newArray['product_price']);
            $product->set_product_onsale($newArray['product_onsale']);
            $product->set_product_presale_price($newArray['product_price_presale']);
            $product->set_product_url($newArray['product_url']);
            $product->set_product_date_added($newArray['product_date_added']);
            $product->set_product_date_available($newArray['product_date_available']);
            $product->set_product_stock_level($newArray['product_stock_level']);
            $product->set_product_viewed_count($newArray['product_viewed_count']);
            $product->set_product_ordered_count($newArray['product_ordered_count']);
            $product->set_product_archived($newArray['product_archived']);

            $productList[$count] = $product;
            $count++;
        }
        return $productList;
    }

    public function getProductOnsaleList() {
        $productList = null;

        $count = 0;
        $link = getConnection();
        $query=" select         product_id,
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
                    where   product_archived = 'N'
                    and     product_onsale  = 'Y'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $product = new Product();
            $product->set_product_id($newArray['product_id']);
            $product->set_manufacturer_id($newArray['manufacturer_id']);
            $product->set_product_sku($newArray['product_sku']);
            $product->set_product_weigth($newArray['product_weigth']);
            $product->set_product_cost($newArray['product_cost']);
            $product->set_product_price($newArray['product_price']);
            $product->set_product_onsale($newArray['product_onsale']);
            $product->set_product_presale_price($newArray['product_price_presale']);
            $product->set_product_url($newArray['product_url']);
            $product->set_product_date_added($newArray['product_date_added']);
            $product->set_product_date_available($newArray['product_date_available']);
            $product->set_product_stock_level($newArray['product_stock_level']);
            $product->set_product_viewed_count($newArray['product_viewed_count']);
            $product->set_product_ordered_count($newArray['product_ordered_count']);
            $product->set_product_archived($newArray['product_archived']);

            $productList[$count] = $product;
            $count++;
        }
        return $productList;
    }

    public function getProductNewArrivalList($numToDisplay=0) {
        $subquery = " ORDER BY product_date_added desc";
        //if number set to 0, display all of them
        if ($numToDisplay > 0) {
            //else only display the number of products according to the setting
            $subquery = $subquery." Limit 0 , ".$numToDisplay;
        }

        $productList = null;

        $count = 0;
        $link = getConnection();
        $query=" select         product_id,
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
                    where   product_archived = 'N'
                    ";

        $query = $query.$subquery;
        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $product = new Product();
            $product->set_product_id($newArray['product_id']);
            $product->set_manufacturer_id($newArray['manufacturer_id']);
            $product->set_product_sku($newArray['product_sku']);
            $product->set_product_weigth($newArray['product_weigth']);
            $product->set_product_cost($newArray['product_cost']);
            $product->set_product_price($newArray['product_price']);
            $product->set_product_onsale($newArray['product_onsale']);
            $product->set_product_presale_price($newArray['product_price_presale']);
            $product->set_product_url($newArray['product_url']);
            $product->set_product_date_added($newArray['product_date_added']);
            $product->set_product_date_available($newArray['product_date_available']);
            $product->set_product_stock_level($newArray['product_stock_level']);
            $product->set_product_viewed_count($newArray['product_viewed_count']);
            $product->set_product_ordered_count($newArray['product_ordered_count']);
            $product->set_product_archived($newArray['product_archived']);

            $productList[$count] = $product;
            $count++;
        }
        return $productList;
    }

    public function getProductMostViewList($numToDisplay=0) {
        $subquery = " ORDER BY product_viewed_count desc ";
        //if number set to 0, display all of them
        if ($numToDisplay > 0) {
            //else only display the number of products according to the setting
            $subquery = $subquery." Limit 0 , ".$numToDisplay;
        }

        $productList = null;

        $count = 0;
        $link = getConnection();
        $query=" select         product_id,
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
                    where   product_archived = 'N'
                    ";

        $query = $query.$subquery;
        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $product = new Product();
            $product->set_product_id($newArray['product_id']);
            $product->set_manufacturer_id($newArray['manufacturer_id']);
            $product->set_product_sku($newArray['product_sku']);
            $product->set_product_weigth($newArray['product_weigth']);
            $product->set_product_cost($newArray['product_cost']);
            $product->set_product_price($newArray['product_price']);
            $product->set_product_onsale($newArray['product_onsale']);
            $product->set_product_presale_price($newArray['product_price_presale']);
            $product->set_product_url($newArray['product_url']);
            $product->set_product_date_added($newArray['product_date_added']);
            $product->set_product_date_available($newArray['product_date_available']);
            $product->set_product_stock_level($newArray['product_stock_level']);
            $product->set_product_viewed_count($newArray['product_viewed_count']);
            $product->set_product_ordered_count($newArray['product_ordered_count']);
            $product->set_product_archived($newArray['product_archived']);

            $productList[$count] = $product;
            $count++;
        }
        return $productList;
    }

    public function getProductByCategory($category_id) {
        $productList = null;

        $count = 0;
        $link = getConnection();
        $query="  select        tb_product.product_id,
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
                    from    tb_product , tb_product_to_category
                    where   product_archived = 'N'
                    and     tb_product_to_category.product_id = tb_product.product_id
                    and     tb_product_to_category.id = ".$category_id."
                    ORDER BY product_date_added desc ";


        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $product = new Product();
            $product->set_product_id($newArray['product_id']);
            $product->set_manufacturer_id($newArray['manufacturer_id']);
            $product->set_product_sku($newArray['product_sku']);
            $product->set_product_weigth($newArray['product_weigth']);
            $product->set_product_cost($newArray['product_cost']);
            $product->set_product_price($newArray['product_price']);
            $product->set_product_onsale($newArray['product_onsale']);
            $product->set_product_presale_price($newArray['product_price_presale']);
            $product->set_product_url($newArray['product_url']);
            $product->set_product_date_added($newArray['product_date_added']);
            $product->set_product_date_available($newArray['product_date_available']);
            $product->set_product_stock_level($newArray['product_stock_level']);
            $product->set_product_viewed_count($newArray['product_viewed_count']);
            $product->set_product_ordered_count($newArray['product_ordered_count']);
            $product->set_product_archived($newArray['product_archived']);

            $productList[$count] = $product;
            $count++;
        }
        return $productList;
    }

    public function getProductByBrand($brand_id) {
        $productList = null;
        $count = 0;
        $link = getConnection();
        $query=" select         product_id,
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
                    where   product_archived = 'N'
                    and     manufacturer_id = ".$brand_id."
                    ORDER BY product_date_added desc
                    ";


        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $product = new Product();
            $product->set_product_id($newArray['product_id']);
            $product->set_manufacturer_id($newArray['manufacturer_id']);
            $product->set_product_sku($newArray['product_sku']);
            $product->set_product_weigth($newArray['product_weigth']);
            $product->set_product_cost($newArray['product_cost']);
            $product->set_product_price($newArray['product_price']);
            $product->set_product_onsale($newArray['product_onsale']);
            $product->set_product_presale_price($newArray['product_price_presale']);
            $product->set_product_url($newArray['product_url']);
            $product->set_product_date_added($newArray['product_date_added']);
            $product->set_product_date_available($newArray['product_date_available']);
            $product->set_product_stock_level($newArray['product_stock_level']);
            $product->set_product_viewed_count($newArray['product_viewed_count']);
            $product->set_product_ordered_count($newArray['product_ordered_count']);
            $product->set_product_archived($newArray['product_archived']);

            $productList[$count] = $product;
            $count++;
        }
        return $productList;
    }

    public function getProductByKeyword($keyword) {
        $keyword = trim($keyword);
        $productList = null;
        $count = 0;
        $link = getConnection();
        $query=" select     DISTINCT (tb_product.product_id) ,
                            tb_product.manufacturer_id,
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
                    from    tb_product, tb_product_description, tb_manufacturer
                    where   product_archived = 'N'
                    and     tb_product_description.product_id = tb_product.product_id
                    and     tb_product_description.product_id = tb_product.product_id
                    and     tb_manufacturer.manufacturer_id = tb_product.manufacturer_id
                    and    ( product_sku like '%".$keyword."%'
                    or      product_name like '%".$keyword."%'
                    or      product_description like '%".$keyword."%'
                    or      manufacturer_name like '%".$keyword."%'
                    )";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $product = new Product();
            $product->set_product_id($newArray['product_id']);
            $product->set_manufacturer_id($newArray['manufacturer_id']);
            $product->set_product_sku($newArray['product_sku']);
            $product->set_product_weigth($newArray['product_weigth']);
            $product->set_product_cost($newArray['product_cost']);
            $product->set_product_price($newArray['product_price']);
            $product->set_product_onsale($newArray['product_onsale']);
            $product->set_product_presale_price($newArray['product_price_presale']);
            $product->set_product_url($newArray['product_url']);
            $product->set_product_date_added($newArray['product_date_added']);
            $product->set_product_date_available($newArray['product_date_available']);
            $product->set_product_stock_level($newArray['product_stock_level']);
            $product->set_product_viewed_count($newArray['product_viewed_count']);
            $product->set_product_ordered_count($newArray['product_ordered_count']);
            $product->set_product_archived($newArray['product_archived']);

            $productList[$count] = $product;
            $count++;
        }
        return $productList;
    }

    public function getProductListUnderStockLevel($stock_warning_level) {
        $productList = null;
        $count = 0;
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
                    where   product_stock_level <= ".$stock_warning_level;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $product = new Product();
            $product->set_product_id($newArray['product_id']);
            $product->set_manufacturer_id($newArray['manufacturer_id']);
            $product->set_product_sku($newArray['product_sku']);
            $product->set_product_weigth($newArray['product_weigth']);
            $product->set_product_cost($newArray['product_cost']);
            $product->set_product_price($newArray['product_price']);
            $product->set_product_onsale($newArray['product_onsale']);
            $product->set_product_presale_price($newArray['product_price_presale']);
            $product->set_product_url($newArray['product_url']);
            $product->set_product_date_added($newArray['product_date_added']);
            $product->set_product_date_available($newArray['product_date_available']);
            $product->set_product_stock_level($newArray['product_stock_level']);
            $product->set_product_viewed_count($newArray['product_viewed_count']);
            $product->set_product_ordered_count($newArray['product_ordered_count']);
            $product->set_product_archived($newArray['product_archived']);

            $productList[$count] = $product;
            $count++;
        }
        return $productList;
    }
}
?>
